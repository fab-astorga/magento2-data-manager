<?php
namespace Items\ItemInformation\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Items\ItemInformation\Api\Data\ShippingDetailsInterface;
use Items\ItemInformation\Api\Data\SafetyDetailsInterface;
use Items\ItemInformation\Api\Data\ItemDetailsInterface;
use Items\ItemInformation\Api\Data\AdditionalDownloadsInterface;
use Items\ItemInformation\Api\Data\WebStoreConfigurationInterface;
use Items\ItemInformation\Api\Data\ItemMainShotsInterface;
use Items\ItemInformation\Api\Data\ItemMatrixShotsInterface;
use Items\ItemInformation\Api\Data\NetSuiteCategoryInterface;
use Items\ItemInformation\Api\ItemShotsManagementInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Items\ItemInformation\Api\ItemManagementInterface;
use Items\ItemInformation\Api\FiltersManagementInterface;
use Integration\Netsuite\Api\DataAuthInterface;

class ItemManagement implements \Items\ItemInformation\Api\ItemManagementInterface 
{
    const CATEGORY_PARENT = 'Products';

    protected $_productRepository;
    protected $_productFactory;
    protected $_shippingDetailsManagement;
    protected $_itemDetailsManagement;
    protected $_safetyDetailsManagement;
    protected $_pricesManagement;
    protected $_webStoreConfigurationManagement;
    protected $_itemShotsManagement;
    protected $_additionalDownloadsManagement;
    protected $_categoryFactory;
    protected $_categoryLinkManagement;
    protected $_categoryLinkRepository;
    protected $_productLinkFactory;
    protected $_netsuiteCategoryRepository;
    protected $_netsuiteCategoryFactory;
    protected $_netsuiteItemRepository;
    protected $_netsuiteItemFactory;
    protected $_categoryRepository;
    protected $_categoryProductLinkFactory;
    protected $_urlRewrite;
    protected $_filtersManagement;
    protected $_colorSwatch;
    protected $_netsuiteIntegration;
    protected $logger;
    protected $_nonInventoryManagement;
    protected $_fedExIntegration;
    protected $_xmlBuilder;
    protected $_categoryCollection;

    // Control variable, for rollback if the product does not exist
    protected $_productExist = false;

    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Catalog\Api\Data\ProductInterfaceFactory $productFactory,
        \Items\ItemInformation\Api\ShippingDetailsManagementInterface $shippingDetailsManagement,
        \Items\ItemInformation\Api\ItemDetailsManagementInterface $itemDetailsManagement,
        \Items\ItemInformation\Api\SafetyDetailsManagementInterface $safetyDetailsManagement,
        \Items\ItemInformation\Api\PricesManagementInterface $pricesManagement,
        \Items\ItemInformation\Api\WebStoreConfigurationManagementInterface $webStoreConfigurationManagement,
        \Items\ItemInformation\Api\ItemShotsManagementInterface $itemShotsManagement,
        \Items\ItemInformation\Api\AdditionalDownloadsManagementInterface $additionalDownloadsManagement,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Catalog\Api\CategoryLinkManagementInterface $categoryLinkManagement,
        \Magento\Catalog\Model\CategoryLinkRepository $categoryLinkRepository,
        \Magento\Catalog\Api\Data\ProductLinkInterfaceFactory $productLinkFactory,
        \Items\ItemInformation\Api\NetSuiteCategoryRepositoryInterface $netsuiteCategoryRepository,
        \Items\ItemInformation\Model\NetSuiteCategoryFactory $netsuiteCategoryFactory,
        \Items\ItemInformation\Api\NetSuiteItemRepositoryInterface $netsuiteItemRepository,
        \Items\ItemInformation\Model\NetSuiteItemFactory $netsuiteItemFactory,
        \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository,
        \Magento\Catalog\Model\CategoryProductLinkFactory $categoryProductLinkFactory, 
        \Magento\UrlRewrite\Model\UrlRewrite $urlRewrite,
        \Items\ItemInformation\Api\FiltersManagementInterface $filtersManagement,
        \Items\ItemInformation\Helper\ColorSwatch $colorSwatch,
        \Integration\Netsuite\Api\IntegrationInterface $netsuiteIntegration,
        \File\CustomLog\Logger\Logger $logger,
        \Items\ItemInformation\Api\NonInventoryManagementInterface $nonInventoryManagement,
        \Integration\FedEx\Api\FedExIntegrationInterface $fedExIntegration,
        \Items\ItemInformation\Helper\XmlBuilder $xmlBuilder,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollection
    ) 
    {
        $this->_productRepository               = $productRepository;
        $this->_productFactory                  = $productFactory;
        $this->_shippingDetailsManagement       = $shippingDetailsManagement;
        $this->_itemDetailsManagement           = $itemDetailsManagement;
        $this->_safetyDetailsManagement         = $safetyDetailsManagement;
        $this->_pricesManagement                = $pricesManagement;
        $this->_webStoreConfigurationManagement = $webStoreConfigurationManagement;
        $this->_itemShotsManagement             = $itemShotsManagement;
        $this->_additionalDownloadsManagement   = $additionalDownloadsManagement;
        $this->_categoryFactory                 = $categoryFactory;
        $this->_categoryLinkManagement          = $categoryLinkManagement;
        $this->_categoryLinkRepository          = $categoryLinkRepository;
        $this->_productLinkFactory              = $productLinkFactory;
        $this->_netsuiteCategoryRepository      = $netsuiteCategoryRepository;
        $this->_netsuiteCategoryFactory         = $netsuiteCategoryFactory;
        $this->_netsuiteItemRepository          = $netsuiteItemRepository;
        $this->_netsuiteItemFactory             = $netsuiteItemFactory;
        $this->_categoryRepository              = $categoryRepository;
        $this->_categoryProductLinkFactory      = $categoryProductLinkFactory;
        $this->_urlRewrite                      = $urlRewrite;
        $this->_filtersManagement               = $filtersManagement;
        $this->_colorSwatch                     = $colorSwatch;
        $this->_netsuiteIntegration             = $netsuiteIntegration;
        $this->logger                           = $logger;
        $this->_nonInventoryManagement          = $nonInventoryManagement;
        $this->_fedExIntegration                = $fedExIntegration; 
        $this->_xmlBuilder                      = $xmlBuilder;
        $this->_categoryCollection              = $categoryCollection;
    }

    /**
     * This method makes an update or save of Items\Products.
     * {@inheritdoc}
     */
    public function saveOrUpdateItem()
    {
        $productSaved = false;
        $productSku = null;

        try {
            // Retrieve all data
            $data = (array) json_decode(file_get_contents('php://input'), true);           
            
            // Save main information
            $itemInformation = $data;
            $product = null;

            /* Check if item is non inventory */
            if ($itemInformation[ItemManagementInterface::SUB_ITEM_OF] == ItemManagementInterface::NON_INVENTORY)
            {
                /** AQUI CREA EL NON INVENTORY (virtual product)   */

                $netsuiteId = $itemInformation[ItemManagementInterface::NETSUITE_ID];
                $sku = $itemInformation[ItemManagementInterface::SKU];
                $product = $this->_nonInventoryManagement->createNonInventoryItem($netsuiteId, $sku);

            } else {

                $product = $this->saveItemMainInformation($itemInformation);

                if($product)
                {
                    $productSaved = true;
                    $productSku =  $product->getSku();
                    $this->logger->info('product sku: ' . $productSku);
                }

                // Save Shipping Details
                $this->logger->info('SAVING SHIPPING DETAILS');
                $shippingDetailsInformation = $this->getExistingKeys(ShippingDetailsInterface::ATTRIBUTES, $data);
                $this->_shippingDetailsManagement->saveShippingDetails($product, $shippingDetailsInformation);
                $this->logger->info('SHIPPING DETAILS SAVED');

                // Save Item Details
                $this->logger->info('SAVING ITEM DETAILS');
                $itemDetailsInformation = $this->getExistingKeys(ItemDetailsInterface::ATTRIBUTES, $data);
                $this->_itemDetailsManagement->saveItemDetails($product, $itemDetailsInformation);
                $this->logger->info('ITEM DETAILS SAVED');

                // Save Safety Details
                $this->logger->info('SAVING SAFETY DETAILS');
                $safetyDetailsInformation = $this->getExistingKeys(SafetyDetailsInterface::ATTRIBUTES, $data);
                $this->_safetyDetailsManagement->saveSafetyDetails($product, $safetyDetailsInformation);
                $this->logger->info('SAFETY DETAILS SAVED');

                // Save Web Store Configuration
                $this->logger->info('SAVING WEB STORE CONF');
                $webStoreInformation = $this->getExistingKeys(WebStoreConfigurationInterface::ATTRIBUTES, $data);
                $this->_webStoreConfigurationManagement->saveWebStoreConfiguration($product, $webStoreInformation);
                $this->logger->info('WEB STORE CONF SAVED');

                // Save images
                $this->logger->info('SAVING IMAGES');
                $itemShotsInformation = [];
                $itemShotsInformation[ItemShotsManagementInterface::MAIN_SHOTS] = $this->getExistingKeys(ItemMainShotsInterface::ATTRIBUTES, $data);
                $this->logger->info('MAIN SHOTS', ['return'=>$itemShotsInformation[ItemShotsManagementInterface::MAIN_SHOTS]]);
                $itemShotsInformation[ItemShotsManagementInterface::MATRIX_SHOTS] = $this->getExistingKeys(ItemMatrixShotsInterface::ATTRIBUTES, $data);
                $this->logger->info('MATRIX SHOTS', ['return'=>$itemShotsInformation[ItemShotsManagementInterface::MATRIX_SHOTS]]);
                $this->_itemShotsManagement->saveItemShots($product, $itemShotsInformation, $itemInformation[ItemManagementInterface::SUB_ITEM_OF]);
                $this->logger->info('IMAGES SUCCESSFULLY SAVED');


                // Save additional downloads
                $this->logger->info('SAVING ADDITIONAL DOWNLOADS');
                $additionalDownloadsInformation = $this->getExistingKeys(AdditionalDownloadsInterface::ATTRIBUTES, $data);
                $this->_additionalDownloadsManagement->saveAdditionalDownloads($product, $additionalDownloadsInformation);
                $this->logger->info('ADDITIONAL DOWNLOADS SAVED');

                // Save related items
                if (array_key_exists(SELF::RELATED_ITEMS, $data)) {
                    $this->saveRelatedItems($product, $data[SELF::RELATED_ITEMS]);
                }

                // Save Filters
                $this->logger->info('SAVING FILTERS');
                $filtersInformation = $this->getExistingKeys(FiltersManagementInterface::FILTERS, $data);
                $this->logger->info('FILTERS ALMOST SAVED');
                $this->_filtersManagement->saveFilters($product, $filtersInformation);
                $this->logger->info('FILTERS SAVED');

                $productType = $product->getTypeId();

                // If is a simple product, we save the configurable - simple product relationship
                if($productType == 'simple')
                {
                    if(array_key_exists(ItemManagementInterface::SUB_ITEM_OF, $itemInformation)
                        && (!empty($itemInformation[ItemManagementInterface::SUB_ITEM_OF]))
                        && ($itemInformation[ItemManagementInterface::SUB_ITEM_OF] != 'simple'))
                    {
                        $this->logger->info('SETTING SIMPLE PRODUCT TO CONFIGURABLE...');
                        $this->setSimpleProductToConfigurable($itemInformation[ItemManagementInterface::SUB_ITEM_OF], $product);
                        $this->logger->info('PRODUCT SET');
                    }
                }

                // Save Prices  *********
                $pricesInformation = $this->getExistingKeys([ItemManagementInterface::PRICES], $data);
                $this->_pricesManagement->savePrices($product, $pricesInformation);

                /************ Custom Attributes / Special Categories (On sale, Clearance, New) *****************/
                $this->logger->info('Before special categories assignment');
                $this->setSpecialCategories($product, $itemInformation);
                $this->logger->info('FINISH', ['return' => $product]);
            }

            $result = [
                "status"=>true,
                "error"=>null
            ];

        } catch(\Exception $error) {
            if($productSaved && !$this->_productExist) {
                $this->_productRepository->deleteById($product->getSku());
            }

            $result = [
                "status"=>false,
                "error"=>$error->getMessage()
            ];
        }

        $response = json_encode($result);
        return $response;
    }

    /**
     * This method delete an item by id
     * {@inheritdoc}
     */
    public function deleteItem()
    {
        try {
            $data = (array) json_decode(file_get_contents('php://input'), true);

            $netsuiteId = $data["netsuite_id"];
            $productId = $this->_netsuiteItemRepository->getByNetSuiteItemId($netsuiteId)->getItemId();
            $product = $this->_productRepository->getById($productId);
            $this->_productRepository->delete($product);

            $result = [
                "status"=>true,
                "error"=>null
            ];

        } catch(\Exception $error) {
            $result = [
                "status"=>false,
                "error"=>$error->getMessage()
            ];
        }

        $response = json_encode($result);
        return $response;
    }

    /**
     * Save main information related with the product
     * {@inheritdoc}
     */
    public function saveItemMainInformation($itemInformation)
    {
        $product;
        // All stores
        $store_id = 0;
        // Magento id
        $productId = null;

        $visibilityOptions = [
            1 => 'Not Visible Individually',
            2 => 'Catalog',
            3 => 'Search',
            4 => 'Catalog, Search'
        ];

        if (!array_key_exists('netsuite_id', $itemInformation)) {
            throw new CouldNotSaveException(__('The product does not have a netsuite id.'));
        }

        $netsuiteId = $itemInformation['netsuite_id'];

        // Trying to get item id
        try {
            $productId = $this->_netsuiteItemRepository->getByNetSuiteItemId($netsuiteId)->getItemId();
        }catch(\Exception $error){
            $productId = -1;
        }

        // If the netsuite item does not exist
        if($productId === -1)
        {
            $this->logger->info('PRODUCT CREATE!!!!');
            if (!array_key_exists(ProductInterface::SKU, $itemInformation)) {
                throw new CouldNotSaveException(__('The product does not have a sku.'));
            }
            $productSku = $itemInformation[ProductInterface::SKU];
            // If the product is a simple product we get that
            if(strpos($productSku, ' : ')){
                $skus = explode(' : ', $productSku);
                $productSku = $skus[1];
            }
            $product = $this->_productFactory->create();
            $product->setSku($productSku); 
        } else {
            $this->logger->info('PRODUCT UPDATE!!!!');

            $product = $this->_productRepository->getById($productId);
            // If the product change their sku
            if (array_key_exists(ProductInterface::SKU, $itemInformation)) {
                $productSku = $itemInformation[ProductInterface::SKU];
                if(strpos($productSku, ' : '))
                {
                    $skus = explode(' : ', $productSku);
                    $productSku = $skus[1];
                }
                $product->setSku($productSku);
                $product->save();
            }
            $this->_productExist = true;
        }
        
        if (array_key_exists(ProductInterface::NAME, $itemInformation)) 
        {
            if($itemInformation[ProductInterface::NAME]) {
                $product->setName($itemInformation[ProductInterface::NAME]);
            }else {
                $product->setName($product->getSku());
            }
        }

        if(array_key_exists('url_component', $itemInformation))
        {
            if($this->_productExist){ 
                $product->addAttributeUpdate('url_key', $itemInformation['url_component'], $store_id);
            }else {
                $product->setCustomAttribute('url_key', $itemInformation['url_component']);
            }
        }

        if (array_key_exists(ItemManagementInterface::SUB_ITEM_OF, $itemInformation))
        {
            if(!empty($itemInformation[ItemManagementInterface::SUB_ITEM_OF]))
            {
                $this->logger->info('PRODUCTO SIMPLE: ' . $product->getSku());
                $name = $product->getSku();
                $product->setTypeId('simple');

                // AQUI SE HACE EL PROCESO PARA CONFIGURABLES SIN HIJOS
                if ($itemInformation[ItemManagementInterface::SUB_ITEM_OF] != 'simple') 
                {
                    $currentValue = array_search("Not Visible Individually", $visibilityOptions);
                } else {
                    $currentValue = array_search("Catalog, Search", $visibilityOptions);
                }
                if(!empty($itemInformation['colors'])) {
                    $this->_colorSwatch->createColorSwatch($name);
                }

                $product->setVisibility($currentValue);

            } else {
                $this->logger->info('PRODUCTO CONFIGURABLE: ' . $product->getSku());
                $product->setTypeId('configurable');
                $currentValue = array_search("Catalog, Search", $visibilityOptions);
                $product->setVisibility($currentValue);
            }
        }

        /************ Default Values *****************/
        if(!$this->_productExist)
        {
            $product->setAttributeSetId(4);
            $product->setStatus(1);
            $product->setWebsiteIds([1]);
            $product->setPrice(0);
            $qty = ItemManagementInterface::DEFAULT_QUANTITY;
            $is_in_stock = true;
            $product->setStockData(['qty' => $qty, 'is_in_stock' => $is_in_stock]);
            $product->setQuantityAndStockStatus(['qty' => $qty, 'is_in_stock' => $is_in_stock]);
        }
    
        // Save product with NetSuiteId
        if($productId === -1) {
            $product = $this->_productRepository->save($product);
            $netsuiteItem = $this->_netsuiteItemFactory->create();
            $netsuiteItem->setNetSuiteItemId($netsuiteId);
            $netsuiteItem->setItemId($product->getId());
            $this->_netsuiteItemRepository->save($netsuiteItem);
        }

        $this->logger->info('PRODUCT MAIN INFORMATION SAVED!!!!');

        return $product;
    }


    /**
     * Get a keys subset of the incoming json
     * @param array $setOfKeys
     * @param array $data
     * @return array
     */
    public function getExistingKeys($setOfKeys, $data)
    {
        $information = [];

        foreach($setOfKeys as $key){
            if(array_key_exists($key, $data)){
                $information[$key] = $data[$key];
            }
        }

        return $information;
    }


    /**
     * This method makes an update or save of related Items\Products.
     * {@inheritdoc}
     */
    public function saveRelatedItems($product, $relatedItems)
    {
        try{
            // We save each link of type related
            foreach($relatedItems as $relatedSku) { 
                try{
                    $relatedProduct = $this->_productRepository->get($relatedSku);
                } catch(\Exception $error){
                    throw new CouldNotSaveException(__('There was an error with the product with id: '.$relatedSku.'. Error details: '.$error->getMessage()), $error);
                }
                $productLink = $this->_productLinkFactory->create()
                ->setSku($relatedSku)
                ->setLinkedProductSku($product->getSku())
                ->setLinkType('related');

                $linkData[] = $productLink;
                $relatedProduct->setProductLinks($linkData);
                $this->_productRepository->save($relatedProduct);
            }

            return true;
        } catch(\Exception $error){
            throw new CouldNotSaveException(__('The related products was unable to be saved or updated. Error details: '.$error->getMessage()), $error);
        }

    }

    /**
     * Save categories
     * {@inheritdoc}
     */
    public function saveCategories()
    {
        try {
            // Retrieve all data
            $category = (array)json_decode(file_get_contents('php://input'), true);

            // Incoming information
            $childCategoryNetsuiteId = null;
            $childName = null;
            $parentCategoryNetsuiteId = null;
            $parentName = null;

            if (!array_key_exists('netsuite_id_child', $category)) {
                throw new CouldNotSaveException(__('There is not a netsuite id for the child category.'));
            }else {
                $childCategoryNetsuiteId = $category['netsuite_id_child'];
            }

            if (array_key_exists('child', $category)) {
                $childName = $category['child'];
            }

            if (array_key_exists('netsuite_id_parent', $category)) {
                $parentCategoryNetsuiteId = $category['netsuite_id_parent'];
            }

            if (array_key_exists('parent', $category)) {
                $parentName = $category['parent'];
            }

            // Map information
            $parentId = null;
            $childId = null;
            $productsCategoryId = null;

            // Default category:    Default Category -> Products Category
            $collection = $this->_categoryFactory->create()->getCollection()->addFieldToFilter('name', ['in'=> 'Default Category']);
            $defaultcategoryId = $collection->getFirstItem()->getId();


            // Products Category
            $productsCategory = $this->_categoryFactory->create()->getCollection()->addFieldToFilter('name', ['in'=>'products'])->addFieldToFilter('parent_id', ['in'=> $defaultcategoryId]);
            if ($productsCategory->getSize()) {
                $productsCategoryId = $productsCategory->getFirstItem()->getId();
            }else {
                throw new CouldNotSaveException(__('There is not a category with the name products in the default category.'));
            } 

            // Trying to get the child id if exist
            try {
                $childId = $this->_netsuiteCategoryRepository->getByNetSuiteCategoryId($childCategoryNetsuiteId)->getCategoryId();
            }catch(\Exception $error){
                $childId = -1;
            }

            // If parent name exist
            if($parentCategoryNetsuiteId){
                try {
                    $parentId = $this->_netsuiteCategoryRepository->getByNetSuiteCategoryId($parentCategoryNetsuiteId)->getCategoryId();
                }catch(\Exception $error){
                    $parentId = -1;
                }
            }

            // If parent does not exist
            if($parentId === -1){
                // Create and save category
                $category = $this->_categoryFactory->create();

                if(!$parentName){
                    throw new CouldNotSaveException(__('There is not a name for the parent category.'));
                }

                $category->setName($parentName);
                $category->setIsActive(true);
                $category->setParentId($productsCategoryId);
                $category->setStoreId(ItemManagementInterface::DEFAULT_STORE_ID);
                $result = $this->_categoryRepository->save($category);
                
                $netsuiteCategory = $this->_netsuiteCategoryFactory->create();
                $netsuiteCategory->setNetSuiteCategoryId($parentCategoryNetsuiteId);
                $netsuiteCategory->setCategoryId($result->getId());
                $this->_netsuiteCategoryRepository->save($netsuiteCategory);

                $parentId = $result->getId();
            }

            // If child does not exist
            if($childId === -1){
                // Create and save category
                $category = $this->_categoryFactory->create();
                
                if(!$childName){
                    throw new CouldNotSaveException(__('There is not a name for the child category.'));
                }

                $category->setName($childName);
                $category->setMetaTitle($childName);
                $category->setIsActive(true);
                $category->setStoreId(ItemManagementInterface::DEFAULT_STORE_ID);

                if($parentId === null){
                    $category->setParentId($productsCategoryId);
                }else {
                    $category->setParentId($parentId);
                }
                $result = $this->_categoryRepository->save($category);
                
                $netsuiteCategory = $this->_netsuiteCategoryFactory->create();
                $netsuiteCategory->setNetSuiteCategoryId($childCategoryNetsuiteId);
                $netsuiteCategory->setCategoryId($result->getId());
                $this->_netsuiteCategoryRepository->save($netsuiteCategory);
                
            } else { // If child exist
                
                // Get Category and change parent
                $category = $this->_categoryRepository->get($childId);
                $category->setStoreId(ItemManagementInterface::DEFAULT_STORE_ID);

                // Change parent?
                if($parentCategoryNetsuiteId === ""){
                    // url rewrite
                    $urlRewriteCollection = $this->_urlRewrite->getCollection()->addFieldToFilter('entity_type', 'category')->addFieldToFilter('entity_id', $childId);
                    $deleteItem = $urlRewriteCollection->getFirstItem(); 
                    if ($urlRewriteCollection->getFirstItem()->getId()) {
                        // url exist
                        $deleteItem->delete();
                    }
                    $category->move($productsCategoryId, null);
                } elseif (!is_null($parentId) && $parentId != $category->getParentCategory()->getId())
                {
                    // url rewrite
                    $urlRewriteCollection = $this->_urlRewrite->getCollection()->addFieldToFilter('entity_type', 'category')->addFieldToFilter('entity_id', $childId);
                    $deleteItem = $urlRewriteCollection->getFirstItem(); 
                    if ($urlRewriteCollection->getFirstItem()->getId()) {
                        // url exist
                        $deleteItem->delete();
                    }
                    $category->move($parentId, null);
                }

                // Change name?
                if($childName){
                    $category->setName($childName);
                    $category->setMetaTitle($childName);
                    // We need use this method to seve the name attribute
                    $category->save();
                    
                    $category->setUrlKey($childName);
                }

                $this->_categoryRepository->save($category);
            }

            $result = [
                "status"=>true,
                "error"=>null
            ];
        
        } catch(\Exception $error) {
            $result = [
                "status"=>false,
                "error"=>$error->getMessage()
            ];
        }

        $response = json_encode($result);
        return $response;
    }

    /**
     * Delete category
     * {@inheritdoc}
     */
    public function deleteCategory()
    {
        try {
            // Retrieve data coming from netsuite
            $category = (array)json_decode(file_get_contents('php://input'), true);
            $netsuiteIdCategory = null;

            if (!array_key_exists('netsuite_id', $category)) {
                throw new CouldNotDeleteException(__('There is not a netsuite id for the category.'));
            } else {
                $netsuiteIdCategory = $category['netsuite_id'];
            }

            $categoryId = $this->_netsuiteCategoryRepository->getByNetSuiteCategoryId($netsuiteIdCategory)->getCategoryId();
            $this->_categoryRepository->deleteByIdentifier($categoryId);

            $result = [
                "status"=>true,
                "error"=>null
            ];

        } catch(\Exception $error) {
            $result = [
                "status"=>false,
                "error"=>$error->getMessage()
            ];
        }

        $response = json_encode($result);
        return $response;
    }

    /**
     * Set Simple Product To Configurable
     * {@inheritdoc}
     */
    public function setSimpleProductToConfigurable($configurableSku, $currentProduct)
    {
        // Retrieve parent product
        $parentProduct;
        try {
            $parentProduct = $this->_productRepository->get($configurableSku);
        } catch(\Error $error){
            throw new CouldNotSaveException(__('The configurable product of simple product does not exist. Error details: '.$error->getMessage()), $error);
        }
        // Retieve color attribute id and set it to the parent
        $color_attr_id = $parentProduct->getResource()->getAttribute('color')->getId();
        $parentProduct->getTypeInstance()->setUsedProductAttributeIds(array($color_attr_id), $parentProduct);
        $configurableAttributesData = $parentProduct->getTypeInstance()->getConfigurableAttributesAsArray($parentProduct);
        $parentProduct->setCanSaveConfigurableAttributes(true);
        $parentProduct->setConfigurableAttributesData($configurableAttributesData);
        $configurableProductsData = array();

        // Link
        $parentProduct->setConfigurableProductsData($configurableProductsData);
        // Get current children
        $productTypeInstance = $parentProduct->getTypeInstance();
        $usedProducts = $productTypeInstance->getUsedProductIds($parentProduct);
        $associatedIds = [];
        foreach ($usedProducts  as $child) {
            $associatedIds[] = $child; 
        }
        $associatedIds[] = $currentProduct->getId();

        // Link with childs
        $parentProduct->setAssociatedProductIds($associatedIds); // Setting Associated Products
        $parentProduct->setCanSaveConfigurableAttributes(true);

        try {
            $this->_productRepository->save($parentProduct);
        } catch(\Exception $e) {
            $this->logger->info('Exception: ' . $e->getMessage());
        }

        return true;
    }

    /**
     * Set special categories
     * @param string \Magento\Catalog\Api\Data\ProductInterface $currentProduct
     * @param array $data
     * @return boolean
     */
    public function setSpecialCategories($currentProduct, $itemInformation)
    {
        $currentCategoriesIds = [];

        /** Temporal solution for Clearance, New and On Sale Categories **/
        $collection = $this->_categoryFactory->create()->getCollection()->addFieldToFilter('name', ['in'=> 'On Sale']);
        $onSaleCategoryId;
        if ($collection->getSize()) 
        {
            $onSaleCategoryId = $collection->getFirstItem()->getId();
            $currentCategoriesIds[] = $onSaleCategoryId;
        }else {
            throw new CouldNotSaveException(__('There is not a category with the name: On Sale.'));
        }

        $collection= $this->_categoryFactory->create()->getCollection()->addFieldToFilter('name', ['in'=> 'clearance']);
        $clearanceCategoryId;
        if ($collection->getSize()) 
        {
            $clearanceCategoryId = $collection->getFirstItem()->getId();
            $currentCategoriesIds[] = $clearanceCategoryId;
        } else {
            throw new CouldNotSaveException(__('There is not a category with the name: Clearance.'));
        }

        $collection = $this->_categoryFactory->create()->getCollection()->addFieldToFilter('name', ['in'=> 'New']);
        $newCategoryId;
        if ($collection->getSize()) 
        {
            $newCategoryId = $collection->getFirstItem()->getId();
            $currentCategoriesIds[] = $newCategoryId;
        }else {
            throw new CouldNotSaveException(__('There is not a category with the name: New.'));
        }
        /** Temporal solution for Clearance, New and On Sale Categories Finish **/

        // Save or update others product categories
        if (array_key_exists(ItemManagementInterface::CATEGORY, $itemInformation)) 
        {
            $netsuiteCategoryId = $itemInformation[ItemManagementInterface::CATEGORY];
            $categoryId;

            try {
                $categoryId = $this->_netsuiteCategoryRepository->getByNetSuiteCategoryId($netsuiteCategoryId)->getCategoryId();
                $currentCategoriesIds[] = $categoryId;
            } catch (\Exception $error){
                throw new CouldNotSaveException(__('The specified category does not exist.'));
            }

            $productSku = $currentProduct->getSku();

            if ($currentProduct->getTypeId() == 'configurable')
            {
                $assigned = $this->assignCategoryToConfigurableProduct($categoryId, $currentProduct->getId());

            } else {
                $this->assignCategoryToProduct($productSku, $categoryId);
            }

            //Check if some category was deleted and update categories product
            $categoryIds = $currentProduct->getCategoryIds();

            $this->logger->info('category IDs product to delete', ['return'=>$categoryIds]);

            foreach ($categoryIds as $simpleCategoryId)
            {
                if(!in_array($simpleCategoryId, $currentCategoriesIds)) {
                    $this->_categoryLinkRepository->deleteByIds((int)$simpleCategoryId, $productSku);
                }
            }
        }

        // Add and remove special categories (Temporal solution)
        $addCategoryIds = [];
        $removeCategoryIds = [];

        if (array_key_exists('on_sale', $itemInformation)) 
        {
            if($itemInformation['on_sale'] == true) { 
                $addCategoryIds[] = $onSaleCategoryId;
            } else {
                $removeCategoryIds[] = $onSaleCategoryId;
            }
        }

        if (array_key_exists('clearance', $itemInformation)) 
        {
            if($itemInformation['clearance'] === "Yes") { 
                $addCategoryIds[] = $clearanceCategoryId;
            } else {
                $removeCategoryIds[] = $clearanceCategoryId;
            }
        }

        if (array_key_exists('new', $itemInformation)) 
        {
            if($itemInformation['new'] === "Yes") { 
                $addCategoryIds[] = $newCategoryId;
            } else {
                $removeCategoryIds[] = $newCategoryId;
            }
        }
        
        foreach($addCategoryIds as $categoryId)
        {
            $this->assignCategoryToProduct($currentProduct->getSku(), $categoryId);
        }

        if (!empty($removeCategoryIds))
        {
            foreach($removeCategoryIds as $categoryId)
            {
                try {
                    $this->_categoryLinkRepository->deleteByIds($categoryId, $currentProduct->getSku());
                } catch(\Exception $e) {
                    // Code if the link does not exist
                    continue;
                }
            }
        }
    }

    /**
     * Set category to configurable products (Temporal solution)
     * 
     * @param int $parentCategoryId
     * @param int $productId
     * @return bool
     */
    public function assignCategoryToConfigurableProduct($parentCategoryId, $productId) 
    {
        try {
            $connection = $this->resource->getConnection();
            $categoryProduct = "INSERT INTO ".self::CATEGORY_PRODUCT_TABLE." (category_id,product_id,position) VALUES (".$parentCategoryId.",".$productId.",0)";
            $categoryProductIndex = "INSERT INTO ".self::CATEGORY_PRODUCT_INDEX_TABLE." (category_id,product_id,position,is_parent,store_id,visibility) VALUES ("
                                    .$parentCategoryId.",".$productId.",0,1,1,4)";

            $connection->query($categoryProduct);
            $connection->query($categoryProductIndex);

        } catch (\Exception $e) {
            throw new Exception(__('Cannot assign category to configurable product.'));
        }

        return true;
    }

    /**
     * Set category to simple products or configurable products without children
     * 
     * @param string $productSku
     * @param int $categoryId
     * @return bool
     */
    public function assignCategoryToProduct($productSku, $categoryId)
    {
        try {
            $categoryProductLink = $this->_categoryProductLinkFactory->create();
            $categoryProductLink->setSku($productSku);
            $categoryProductLink->setCategoryId($categoryId);
            $categoryProductLink->setPosition(0);
            $this->_categoryLinkRepository->save($categoryProductLink);

        } catch (\Exception $e) {
            //$this->logger->info('ERROR: '.$e->getMessage());
            throw new Exception(__('Cannot assign category to simple product.'));
        }

        return true;
    }

    /**
     * Check inventory from Magento to Netsuite
     * 
     * @param int $itemId
     * @param int $quantity
     * @return boolean
     */
    public function checkInventory($itemId, $quantity)
    {
        try {
            $netsuiteId = $this->_netsuiteItemRepository->get($itemId, 'item_id')->getNetSuiteItemId();
            $script = 1759;
            $deploy = 1;
            $method = "GET";
            $url = DataAuthInterface::RESTLET_URL.'?script='.$script.'&deploy='.$deploy.
                    '&netsuite_id='.$netsuiteId.'&quantity='.$quantity;
            $params = [
                "netsuite_id" => $netsuiteId,
                "quantity"    => $quantity
            ];

            $response = $this->_netsuiteIntegration->getNetsuiteResponse($url, $method, $script, $deploy, $params);
            $result = json_decode($response, true);

            if (!empty($result["error"])) {
                return $result["error"];
            }

            $this->logger->info('check inventory', ['return'=>$result]);
            $stock = $result["stock_list"];

            // Recorrer el stock list y ver cuales productos están disponibles

            return $stock[0]["stock_available"];

        } catch (\Exception $e) {
            $this->logger->info('Exception: ' . $e->getMessage());
        }
    }

    /**
     * Check total estimate shipping result according to zip code and
     * the amount of items
     * 
     * @param int $zipCode
     * @param int $requestedQuantity
     * @return string
     */
    public function estimateShipping($zipCode, $requestedQuantity)
    {
        /* Set connection with FedEx */
        $xmlFedExRequest = $this->_xmlBuilder->buildXmlFedEx($zipCode, $requestedQuantity);
        $response = $this->_fedExIntegration->sendFedExRateRequest($xmlFedExRequest);

        //$xml = simplexml_load_string($response);
        
        $this->logger->info('FEDEX JSON: ',['return'=>$response]);

        return $response;
    }

    /**
     * Retrieve all category names available
     * 
     * @return array
     */
    public function getAvailableCategories()
    {
        $categories = $this->_categoryCollection->create();
        $categoryIds = array();
        $childNames = array();

        foreach ($categories as $category)
        {
            $tmpCategory = $this->_categoryRepository->get($category->getId());
            if ($tmpCategory->getName() == self::CATEGORY_PARENT) 
            {                
                $categoryIds = explode(',',$tmpCategory->getChildren());
                foreach ($categoryIds as $child)
                {
                    $childCategory = $this->_categoryRepository->get($child)->getName();
                    $childNames[] = $childCategory; 
                }
            }
        }

        return $childNames;
    }
}