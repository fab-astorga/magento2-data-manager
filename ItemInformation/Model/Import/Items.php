<?php

namespace Items\ItemInformation\Model\Import;

use Exception;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\ImportExport\Helper\Data as ImportHelper;
use Magento\ImportExport\Model\Import;
use Magento\ImportExport\Model\Import\Entity\AbstractEntity;
use Magento\ImportExport\Model\Import\ErrorProcessing\ProcessingErrorAggregatorInterface;
use Magento\ImportExport\Model\ResourceModel\Helper;
use Magento\ImportExport\Model\ResourceModel\Import\Data;
use \Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Items\ItemInformation\Api\Data\ShippingDetailsInterface;
use Items\ItemInformation\Api\Data\SafetyDetailsInterface;
use Items\ItemInformation\Api\Data\ItemDetailsInterface;
use Items\ItemInformation\Api\Data\AdditionalDownloadsInterface;
use Items\ItemInformation\Api\Data\WebStoreConfigurationInterface;
use Items\ItemInformation\Api\Data\ItemMainShotsInterface;
use Items\ItemInformation\Api\Data\ItemMatrixShotsInterface;
use Items\ItemInformation\Api\ItemShotsManagementInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Items\ItemInformation\Api\ItemManagementInterface;
use Items\ItemInformation\Api\FiltersManagementInterface;


/**
 * Class Courses
 */
class Items extends AbstractEntity
{
    const ENTITY_CODE = 'items';
    const TABLE = 'item_details';
    const ENTITY_ID_COLUMN = 'entity_id';
    const CATEGORY_PRODUCT_TABLE = 'catalog_category_product';
    const CATEGORY_PRODUCT_INDEX_TABLE = 'catalog_category_product_index_store1';
    const DEFAULT_QUANTITY = 100;

    /**
     * If we should check column names
     */
    protected $needColumnCheck = true;

    /**
     * Need to log in import history
     */
    protected $logInHistory = true;

    /**
     * Permanent entity columns.
     */
    protected $_permanentAttributes = [
        'netsuite_id'
    ];

    /**
     * Valid column names
     */
    protected $validColumnNames = [
        'netsuite_id',
        'sku',
        'schedule_b_number',
        'individual_item_weight_oz',
        'gift_box_weight_oz',
        'total_item_weight',
        'total_item_weight_unit',
        'items_per_carton',
        'gift_box_color',
        'package',
        'carton_size',
        'carton_weight_oz',
        'total_carton_weight_lbs',
        'shipping_data_verified',
        'total_cartons_per_pallet',
        'pack_out_quantity',
        'ice_pack_required',
        'sales_description',
        'item_pms_color',
        'item_packaging',
        'item_material',
        'patent_number',
        'recycle_number',
        'mah',
        'item_gusset',
        'item_handle_length',
        'item_volume_in_oz',
        'item_depth',
        'item_width',
        'item_height',
        'item_top_diameter',
        'item_bottom_diameter',
        'item_length',
        'item_diameter',
        'fits_car_cup_holder',
        'microwave_safe',
        'top_rack_dishwasher_safe',
        'carabiner_included',
        'spill_proof',
        'spill_persistant',
        'handwash_only',
        'batteries_included',
        'safety_details_name',
        'safety_details_link',
        'safety_details_name_2',
        'safety_details_link_2',
        'safety_details_name_3',
        'safety_details_link_3',
        'on_sale',
        'clearance',
        'new',
        'page_title',
        'item_number_for_webstore',
        'summary_store_description',
        'detailed_description',
        'summary_description_for_imprint_methods',
        'create_virtual_link',
        'create_flyer',
        'parent_summary_store_description',
        'out_of_stock_behavior',
        'out_of_stock_message',
        'no_price_message',
        'select_color_for_pricing',
        'coupon_code',
        'color_disclaimer',
        'price_includes',
        'item_notes_for_web',
        'video_link',
        'video_name',
        'maximum_variable_amount',
        'display_in_webstore',
        'override_web_inventory',
        'variable_amount',
        'show_default_amount',
        'do_not_show_price',
        'item_group_shot',
        'item_glamour_shot',
        'glamour_shot_alt_1',
        'group_shot_alt_1',
        'group_shot_alt_2',
        'lid_1_shot',
        'lid_2_shot',
        'gift_box_alt_1',
        'gift_box_alt_2',
        'matrix_image',
        'webstore_color_order',
        'alternate_image_1',
        'alternate_image_2',
        'alternate_image_3',
        'alternate_image_4',
        'additional_shipping_costs',
        'new_color_added',
        'safety_test_available',
        'safety_test_date',
        'prop65_warning',
        'safety_test_link',
        'fda_test_link',
        'tt_downloads_documents_link_1',
        'tt_downloads_documents_link_2',
        'tt_downloads_documents_link_3',
        'tt_downloads_documents_name_1',
        'tt_downloads_documents_name_2',
        'tt_downloads_documents_name_3',
        'tt_download_image_1',
        'tt_download_image_2',
        'tt_download_image_3',
        'tt_download_image_name_1',
        'tt_download_image_name_2',
        'tt_download_image_name_3',
        'tt_download_image_4',
        'tt_download_image_5',
        'tt_download_image_6',
        'tt_download_image_name_4',
        'tt_download_image_name_5',
        'tt_download_image_name_6',
        'tt_download_image_name_7',
        'tt_download_image_7',
        'tt_download_image_name_8',
        'tt_download_image_8',
        'always_available',
        'esp_item_keywords',
        'category',
        'drinkware_type',
        'drinkware_material',
        'vacuum_sealed',
        'technology_type',
        'power_banks',
        'imprint_methods_type',
        'bags_type',
        'gift_sets_type',
        'confectionary',
        'lifestyle_type',
        'auto_accesories',
        'tech_sets',
        'writing_type',
        'office_type',
        'colors',
        'summer_coolers',
        'breast_cancer_awareness',
        'back_to_school',
        'sub_item_of',
        'name',
        'TT_ItemOption_FirstColor',
        'TT_ItemOption_SecondColor',
        'TT_ItemOption_ThridColor',
        'TT_ItemOption_FourthColor',
        'TT_ItemOption_FifthColor',
        'TT_ItemOption_SixthColor',
        'TT_ItemOption_EighthColor',
        'TT_ItemOption_NinthColor',
        'TT_ItemOption_TenthColor',
        'TT_ItemOption_EleventhColor',
        'TT_ItemOption_TwelfthColor',
        'TT_ItemOption_ThirteenthColor',
        'TT_ItemOption_FourteenthColor',
        'TT_ItemOption_FifteenthColor',
        'TT_ItemOption_SixteenthColor',
        'TT_ItemOption_EighteenthColor',
        'matrix_item_option_color',
        'url_component'
    ];

    /**
     * @var AdapterInterface
     */
    protected $connection;

    /**
     * @var ResourceConnection
     */
    private $resource;

    private $_itemManagement;

    private $logger;

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
    protected $_netsuiteItemRepository;
    protected $_netsuiteItemFactory;
    protected $_categoryProductLinkFactory;
    protected $_productLinkFactory;
    protected $_filtersManagement;
    protected $_categoryRepository;
    protected $_colorSwatch;
    protected $_configurableLinkManagement;
    protected $_nonInventoryManagement;

    // Control variable, for rollback if the product does not exist
    protected $_productExist = false;

    /**
     * Courses constructor.
     *
     * @param JsonHelper $jsonHelper
     * @param ImportHelper $importExportData
     * @param Data $importData
     * @param ResourceConnection $resource
     * @param Helper $resourceHelper
     * @param ProcessingErrorAggregatorInterface $errorAggregator
     */
    public function __construct(
        JsonHelper $jsonHelper,
        ImportHelper $importExportData,
        Data $importData,
        ResourceConnection $resource,
        Helper $resourceHelper,
        ProcessingErrorAggregatorInterface $errorAggregator,
        \Items\ItemInformation\Api\ItemManagementInterface $itemManagement,
        \File\CustomLog\Logger\Logger $logger,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Catalog\Api\Data\ProductInterfaceFactory $productFactory,
        \Items\ItemInformation\Api\ShippingDetailsManagementInterface $shippingDetailsManagement,
        \Items\ItemInformation\Api\ItemDetailsManagementInterface $itemDetailsManagement,
        \Items\ItemInformation\Api\SafetyDetailsManagementInterface $safetyDetailsManagement,
        \Items\ItemInformation\Api\PricesManagementInterface $pricesManagement,
        \Items\ItemInformation\Api\WebStoreConfigurationManagementInterface $webStoreConfigurationManagement,
        \Items\ItemInformation\Api\ItemShotsManagementInterface $itemShotsManagement,
        \Items\ItemInformation\Api\AdditionalDownloadsManagementInterface $additionalDownloadsManagement,
        \Items\ItemInformation\Api\NetSuiteItemRepositoryInterface $netsuiteItemRepository,
        \Items\ItemInformation\Model\NetSuiteItemFactory $netsuiteItemFactory,
        \Items\ItemInformation\Api\NetSuiteCategoryRepositoryInterface $netsuiteCategoryRepository,
        \Magento\Catalog\Model\CategoryProductLinkFactory $categoryProductLinkFactory,
        \Items\ItemInformation\Model\NetSuiteCategoryFactory $netsuiteCategoryFactory,
        \Items\ItemInformation\Api\FiltersManagementInterface $filtersManagement,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Catalog\Api\CategoryLinkManagementInterface $categoryLinkManagement,
        \Magento\Catalog\Model\CategoryLinkRepository $categoryLinkRepository,
        \Magento\Catalog\Api\Data\ProductLinkInterfaceFactory $productLinkFactory,
        \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository,
        \Items\ItemInformation\Helper\ColorSwatch $colorSwatch,
        \Magento\ConfigurableProduct\Api\LinkManagementInterface $configurableLinkManagement,
        \Items\ItemInformation\Api\NonInventoryManagementInterface $nonInventoryManagement
    ) {
        $this->jsonHelper                       = $jsonHelper;
        $this->_importExportData                = $importExportData;
        $this->_resourceHelper                  = $resourceHelper;
        $this->_dataSourceModel                 = $importData;
        $this->resource                         = $resource;
        $this->connection                       = $resource->getConnection(ResourceConnection::DEFAULT_CONNECTION);
        $this->errorAggregator                  = $errorAggregator;
        $this->_itemManagement                  = $itemManagement;
        $this->logger                           = $logger;
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
        $this->_netsuiteItemRepository          = $netsuiteItemRepository;
        $this->_netsuiteItemFactory             = $netsuiteItemFactory;
        $this->_netsuiteCategoryRepository      = $netsuiteCategoryRepository;
        $this->_netsuiteCategoryFactory         = $netsuiteCategoryFactory;
        $this->_filtersManagement               = $filtersManagement;
        $this->_categoryProductLinkFactory      = $categoryProductLinkFactory;
        $this->_productLinkFactory              = $productLinkFactory;
        $this->_categoryRepository              = $categoryRepository;
        $this->_colorSwatch                     = $colorSwatch;
        $this->_configurableLinkManagement      = $configurableLinkManagement;
        $this->_nonInventoryManagement          = $nonInventoryManagement;
        $this->initMessageTemplates();
    }

    /**
     * Entity type code getter.
     *
     * @return string
     */
    public function getEntityTypeCode()
    {
        return static::ENTITY_CODE;
    }

    /**
     * Get available columns
     *
     * @return array
     */
    public function getValidColumnNames(): array
    {
        return $this->validColumnNames;
    }

    /**
     * Row validation
     *
     * @param array $rowData
     * @param int $rowNum
     *
     * @return bool
     */
    public function validateRow(array $rowData, $rowNum): bool
    {
        $sku = $rowData['sku'] ?? '';
        $netsuiteId = $rowData['netsuite_id'] ?? '';

        if (!$sku) {
            $this->addRowError('sku', $rowNum);
        }

        if (!$netsuiteId) {
            $this->addRowError('netsuite_id', $rowNum);
        }

        if (isset($this->_validatedRows[$rowNum])) {
            return !$this->getErrorAggregator()->isRowInvalid($rowNum);
        }

        $this->_validatedRows[$rowNum] = true;

        return !($this->getErrorAggregator()->isRowInvalid($rowNum));
    }

    /**
     * Import data
     *
     * @return bool
     *
     * @throws Exception
     */
    protected function _importData(): bool
    {
        switch ($this->getBehavior())
        {
            case Import::BEHAVIOR_APPEND:
                $this->saveAndReplaceEntity();
                break;
            case Import::BEHAVIOR_REPLACE:
                $this->saveAndReplaceEntity();
                break;
            case Import::BEHAVIOR_DELETE:
                $this->saveAndReplaceEntity();        // ERROR #1
                break;
        }

        return true;
    }

    /**
     * Delete entities
     *
     * @return bool
     */
    private function deleteEntity(): bool
    {
        while ($bunch = $this->_dataSourceModel->getNextBunch())
        {
            $entityList = [];

            foreach ($bunch as $rowNum => $row) {
                if (!$this->validateRow($row, $rowNum)) {
                    continue;
                }

                if ($this->getErrorAggregator()->hasToBeTerminated()) {
                    $this->getErrorAggregator()->addRowToSkip($rowNum);

                    continue;
                }

                $columnValues = [];

                foreach ($this->getAvailableColumns() as $columnKey) {
                    $columnValues[$columnKey] = $row[$columnKey];
                }
                $this->countItemsDeleted += 1;
                $entityList[] = $columnValues;
            }
            if ($entityList) {
                $this->deleteEntities($entityList);
            }
        }

        return false;
    }

    /**
     * Save and replace entities
     *
     * @return void
     */
    private function saveAndReplaceEntity()
    {
        $behavior = Import::BEHAVIOR_APPEND;  // Error #2
     //   $this->logger->info('behavior: ' . $behavior);

        while ($bunch = $this->_dataSourceModel->getNextBunch()) {
            $entityList = [];

            foreach ($bunch as $rowNum => $row) {
                if (!$this->validateRow($row, $rowNum)) {
                    continue;
                }

                if ($this->getErrorAggregator()->hasToBeTerminated()) {
                    $this->getErrorAggregator()->addRowToSkip($rowNum);

                    continue;
                }

                $columnValues = [];

                foreach ($this->getAvailableColumns() as $columnKey) {
                    $columnValues[$columnKey] = $row[$columnKey];
                }

                $entityList[] = $columnValues;
                $this->countItemsCreated += (int) !isset($row[static::ENTITY_ID_COLUMN]);
                $this->countItemsUpdated += (int) isset($row[static::ENTITY_ID_COLUMN]);
            }

            if (Import::BEHAVIOR_REPLACE === $behavior)
            {
                    $this->deleteEntities($entityList);
                    $this->saveEntities($entityList);
            }
            elseif (Import::BEHAVIOR_APPEND === $behavior)
            {
                    $this->saveEntities($entityList);
            }
        }
    }

    /**
     * Get available columns
     *
     * @return array
     */
    private function getAvailableColumns(): array
    {
        return $this->validColumnNames;
    }

    /**
     * Init Error Messages
     */
    private function initMessageTemplates()
    {
        $this->addMessageTemplate(
            'NetsuiteIdIsRequired',
            __('Netsuite ID cannot be empty.')
        );
        $this->addMessageTemplate(
            'SkuIsRequired',
            __('sku can not be empty.')
        );
    }

    private function saveEntities($entityList)
    {
        foreach ($entityList as $entity)
        {
            $this->_productExist = false;
            $productSaved = false;
            $productId = null;

            // Retrieve all data
            $data = $entity;

            // Save main information
            $itemInformation = $data;

            /* Check if item is non inventory */
            if ($itemInformation[ItemManagementInterface::SUB_ITEM_OF] == ItemManagementInterface::NON_INVENTORY)
            {
                /** AQUI CREA EL NON INVENTORY (virtual product)   */

                $netsuiteId = $itemInformation[ItemManagementInterface::NETSUITE_ID];
                $sku = $itemInformation[ItemManagementInterface::SKU];
                $this->_nonInventoryManagement->createNonInventoryItem($netsuiteId, $sku);

            } else {

                try {
                    $product = $this->saveItemMainInformation($itemInformation);
                } catch(\Error $error) {
                    $this->logger->info('ERROR: ' . $error);
                }
    
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
    
                /************ Custom Attributes / Special Categories (On sale, Clearance, New) *****************/
                $this->logger->info('Before special categories assignment');
                $this->setSpecialCategories($product, $itemInformation); // ERROR #3
                $this->logger->info('FINISH', ['return' => $entity]);
            }
        }
    }

    private function deleteEntities($entityList)
    {
        foreach ($entityList as $entity)
        {
            $productSku = $entity['sku'];
            $this->_productRepository->deleteById($productSku);
        }
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
            if (!array_key_exists(ProductInterface::SKU, $itemInformation)) {
                throw new CouldNotSaveException(__('The product does not have a sku.'));
            }

            $productSku = $itemInformation[ProductInterface::SKU];
            // If the product is a simple produc t we get that
            if(strpos($productSku, ' : ')){
                $skus = explode(' : ', $productSku);
                $productSku = $skus[1];
            }
            $product = $this->_productFactory->create();
            $product->setSku($productSku);
        } else {
            $product = $this->_productRepository->getById($productId);
            // If the product change their sku
            if (array_key_exists(ProductInterface::SKU, $itemInformation))
            {
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
            if($itemInformation[ProductInterface::NAME]){
                $product->setName($itemInformation[ProductInterface::NAME]);
            }else {
                $product->setName($product->getSku());
            }
        }
        if(array_key_exists('url_component', $itemInformation))
        {
            if($this->_productExist) {
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
            $qty = self::DEFAULT_QUANTITY;
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
     * 
     * @param array $setOfKeys
     * @param array $data
     * @return array
     */
    public function getExistingKeys($setOfKeys, $data)
    {
        $information = [];

        foreach($setOfKeys as $key)
        {
            if(array_key_exists($key, $data)) {
                $information[$key] = $data[$key];
            }
        }

        return $information;
    }


    /**
     * This method makes an update or save of related Items\Products.
     */
    public function saveRelatedItems($product, $relatedItems)
    {
        try{
            // We save each link of type related
            foreach($relatedItems as $relatedSku){
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
     * Set Simple Product To Configurable
     */
    public function setSimpleProductToConfigurable($configurableSku, $currentProduct)
    {
        // Retrieve parent product
        try {
            $parentProduct = $this->_productRepository->get($configurableSku);
        } catch(\Error $error){
            throw new CouldNotSaveException(__('The configurable product of simple product does not exist. Error details: '.$error->getMessage()), $error);
        }

        // Retrieve color attribute id and set it to the parent
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
     * 
     * @param \Magento\Catalog\Api\Data\ProductInterface $currentProduct
     * @param array $data
     * @return bool
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
           // $this->logger->info('ERROR: '.$e->getMessage());
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
}