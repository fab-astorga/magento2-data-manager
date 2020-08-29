<?php
namespace Items\ItemInformation\Model;

use Items\ItemInformation\Api\Data\WebStoreConfigurationInterface;

class WebStoreConfigurationManagement implements \Items\ItemInformation\Api\WebStoreConfigurationManagementInterface {
 
    protected $_webStoreConfigurationFactory;
    protected $_webStoreConfigurationRepository;
    protected $_productRepository;

    public function __construct(
        \Items\ItemInformation\Model\WebStoreConfigurationFactory $webStoreConfigurationFactory,
        \Items\ItemInformation\Api\WebStoreConfigurationRepositoryInterface $webStoreConfigurationRepository,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
    ) 
    {
        $this->_webStoreConfigurationFactory = $webStoreConfigurationFactory;
        $this->_webStoreConfigurationRepository = $webStoreConfigurationRepository;
        $this->_productRepository = $productRepository;
    }

    /**
     * Returns true if the web store configuration saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $webStoreInformation
     * @return boolean
     */
    public function saveWebStoreConfiguration($product, $webStoreInformation) {
        $webStoreConfiguration;

        try {
            $webStoreConfiguration = $this->_webStoreConfigurationRepository->getByProductId($product->getIdBySku($product->getSku()));
        } catch(\Exception $error){
            $webStoreConfiguration = $this->_webStoreConfigurationFactory->create();
            $webStoreConfiguration->setItemId($product->getIdBySku($product->getSku()));
        }

        if (array_key_exists(WebStoreConfigurationInterface::PAGE_TITLE, $webStoreInformation)) {
            $webStoreConfiguration->setPageTitle((string)$webStoreInformation[WebStoreConfigurationInterface::PAGE_TITLE]);
        }
        
        if (array_key_exists(WebStoreConfigurationInterface::ITEM_NUMBER_FOR_WEBSTORE, $webStoreInformation)) {
            $webStoreConfiguration->setItemNumberForWebstore((string)$webStoreInformation[WebStoreConfigurationInterface::ITEM_NUMBER_FOR_WEBSTORE]);
        }
        
        if (array_key_exists(WebStoreConfigurationInterface::SUMMARY_STORE_DESCRIPTION, $webStoreInformation)) {
            $webStoreConfiguration->setSummaryStoreDescription((string)$webStoreInformation[WebStoreConfigurationInterface::SUMMARY_STORE_DESCRIPTION]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::DETAILED_DESCRIPTION, $webStoreInformation)) {
            $webStoreConfiguration->setDetailedDescription((string)$webStoreInformation[WebStoreConfigurationInterface::DETAILED_DESCRIPTION]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::SUMMARY_DESCRIPTION_FOR_IMPRINT_METHODS, $webStoreInformation)) {
            $webStoreConfiguration->setSummaryDescriptionForImprintMethods((string)$webStoreInformation[WebStoreConfigurationInterface::SUMMARY_DESCRIPTION_FOR_IMPRINT_METHODS]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::CREATE_VIRTUAL_LINK, $webStoreInformation)) {
            $webStoreConfiguration->setCreateVirtualLink((string)$webStoreInformation[WebStoreConfigurationInterface::CREATE_VIRTUAL_LINK]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::CREATE_FLYER, $webStoreInformation)) {
            $webStoreConfiguration->setCreateFlyer((string)$webStoreInformation[WebStoreConfigurationInterface::CREATE_FLYER]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::PARENT_SUMMARY_STORE_DESCRIPTION, $webStoreInformation)) {
            $webStoreConfiguration->setParentSummaryStoreDescription((string)$webStoreInformation[WebStoreConfigurationInterface::PARENT_SUMMARY_STORE_DESCRIPTION]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::OUT_OF_STOCK_BEHAVIOR, $webStoreInformation)) {
            $webStoreConfiguration->setOutOfStockBehavior((string)$webStoreInformation[WebStoreConfigurationInterface::OUT_OF_STOCK_BEHAVIOR]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::OUT_OF_STOCK_MESSAGE, $webStoreInformation)) {
            $webStoreConfiguration->setOutOfStockMessage((string)$webStoreInformation[WebStoreConfigurationInterface::OUT_OF_STOCK_MESSAGE]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::NO_PRICE_MESSAGE, $webStoreInformation)) {
            $webStoreConfiguration->setNoPriceMessage((string)$webStoreInformation[WebStoreConfigurationInterface::NO_PRICE_MESSAGE]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::SELECT_COLOR_FOR_PRICING, $webStoreInformation)) {
            $webStoreConfiguration->setSelectColorForPricing((string)$webStoreInformation[WebStoreConfigurationInterface::SELECT_COLOR_FOR_PRICING]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::COUPON_CODE, $webStoreInformation)) {
            $webStoreConfiguration->setCouponCode((string)$webStoreInformation[WebStoreConfigurationInterface::COUPON_CODE]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::COLOR_DISCLAIMER, $webStoreInformation)) {
            $webStoreConfiguration->setColorDisclaimer((string)$webStoreInformation[WebStoreConfigurationInterface::COLOR_DISCLAIMER]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::PRICE_INCLUDES, $webStoreInformation)) {
            $webStoreConfiguration->setPriceIncludes((string)$webStoreInformation[WebStoreConfigurationInterface::PRICE_INCLUDES]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::ITEM_NOTES_FOR_WEB, $webStoreInformation)) {
            $webStoreConfiguration->setItemNotesForWeb((string)$webStoreInformation[WebStoreConfigurationInterface::ITEM_NOTES_FOR_WEB]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::ESP_ITEM_KEYWORDS, $webStoreInformation)) {
            $webStoreConfiguration->setEspItemKeywords((string)$webStoreInformation[WebStoreConfigurationInterface::ESP_ITEM_KEYWORDS]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::VIDEO_LINK, $webStoreInformation)) {
            $webStoreConfiguration->setVideoLink((string)$webStoreInformation[WebStoreConfigurationInterface::VIDEO_LINK]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::VIDEO_NAME, $webStoreInformation)) {
            $webStoreConfiguration->setVideoName((string)$webStoreInformation[WebStoreConfigurationInterface::VIDEO_NAME]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::MAXIMUM_VARIABLE_AMOUNT, $webStoreInformation)) {
            $webStoreConfiguration->setMaximumVariableAmount((float)$webStoreInformation[WebStoreConfigurationInterface::MAXIMUM_VARIABLE_AMOUNT]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::DISPLAY_IN_WEBSTORE, $webStoreInformation)) {
            $webStoreConfiguration->setDisplayInWebstore((boolean)$webStoreInformation[WebStoreConfigurationInterface::DISPLAY_IN_WEBSTORE]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::OVERRIDE_WEB_INVENTORY, $webStoreInformation)) {
            $webStoreConfiguration->setOverrideWebInventory((boolean)$webStoreInformation[WebStoreConfigurationInterface::OVERRIDE_WEB_INVENTORY]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::VARIABLE_AMOUNT, $webStoreInformation)) {
            $webStoreConfiguration->setVariableAmount((boolean)$webStoreInformation[WebStoreConfigurationInterface::VARIABLE_AMOUNT]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::SHOW_DEFAULT_AMOUNT, $webStoreInformation)) {
            $webStoreConfiguration->setShowDefaultAmount((boolean)$webStoreInformation[WebStoreConfigurationInterface::SHOW_DEFAULT_AMOUNT]);
        }

        if (array_key_exists(WebStoreConfigurationInterface::DO_NOT_SHOW_PRICE, $webStoreInformation)) {
            $webStoreConfiguration->setDoNotShowPrice((boolean)$webStoreInformation[WebStoreConfigurationInterface::DO_NOT_SHOW_PRICE]);
        }

        $this->_webStoreConfigurationRepository->save($webStoreConfiguration);

        $this->addWebStoreConfigurationToProduct($product, $webStoreConfiguration);

        return true;
    }

    /**
     * Returns true if the web store configuration saved correctly to product.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param \Items\ItemInformation\Api\Data\WebStoreConfigurationInterface $webStoreConfiguration
     * @return boolean
     */
    public function addWebStoreConfigurationToProduct($product, $webStoreConfiguration) 
    {
        try {
            $product->addAttributeUpdate('meta_title', $webStoreConfiguration->getPageTitle(), 0);
        }catch(\Exception $error) {
            $product->setMetaTitle($webStoreConfiguration->getPageTitle());
        } 

        try {
            $product->addAttributeUpdate('meta_description', $webStoreConfiguration->getSummaryStoreDescription(), 0);
        }catch(\Exception $error) {
            $product->setMetaDescription($webStoreConfiguration->getSummaryStoreDescription());
        } 

        try {
            $product->addAttributeUpdate('description', $webStoreConfiguration->getDetailedDescription(), 0);
        }catch(\Exception $error) {
            $product->setDescription($webStoreConfiguration->getDetailedDescription());
        } 

        try {
            $product->addAttributeUpdate('short_description', $webStoreConfiguration->getDetailedDescription(), 0);
        }catch(\Exception $error) {
            $product->setShortDescription($webStoreConfiguration->getDetailedDescription());
        }
        
        try {
            $product->addAttributeUpdate('meta_keyword', $webStoreConfiguration->getEspItemKeywords(), 0);
        }catch(\Exception $error) {
            $product->setKeywords($webStoreConfiguration->getEspItemKeywords());
        } 

        $this->_productRepository->save($product);

        return true;
    }

}