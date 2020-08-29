<?php

namespace Items\ItemInformation\Plugin\Prices;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Items\ItemInformation\Model\ResourceModel\Prices\PricesLink;
use Magento\Catalog\Api\Data\ProductSearchResultsInterface;

class GetPrices 
{
    const CANADA = 'CA';

    protected $_pricesFactory;
    protected $_priceListFactory;
    protected $_pricesLink;
    protected $_pricesManagement;
    protected $_customerSession;
    protected $_storeManager;
    protected $_logger;

    public function __construct(
        \Items\ItemInformation\Model\PricesFactory $pricesFactory,
        \Items\ItemInformation\Model\PriceListFactory $priceListFactory,
        \Items\ItemInformation\Model\ResourceModel\Prices\PricesLink $pricesLink,
        \Items\ItemInformation\Api\PricesManagementInterface $pricesManagement,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \File\CustomLog\Logger\Logger $logger
    ) 
    {
        $this->_pricesFactory    = $pricesFactory;
        $this->_priceListFactory = $priceListFactory;
        $this->_pricesLink       = $pricesLink;
        $this->_pricesManagement = $pricesManagement;
        $this->_customerSession  = $customerSession;
        $this->_storeManager     = $storeManager;
        $this->_logger            = $logger;
    }
    
    /**
     * Get Prices of product
     *
     * @param ProductRepositoryInterface $subject
     * @param ProductInterface $product
     * @return ProductInterface
     */
    public function afterGet(ProductRepositoryInterface $subject, ProductInterface $product): ProductInterface
    {
        $productId = $product->getIdBySku($product->getSku());

        $pricesArray = [];
        
        // Product attributes
        $isOnSale = false;
        $clearance = false;

        // Try to get on sale value
        try{
            $isOnSaleValue = $product->getAttributeText('on_sale');
            if($isOnSaleValue === "Yes"){
                $isOnSale = true;
            }
        } catch(\Error $error){
            $isOnSale = false;
        }

        // Try to get clearance value
        try{
            $clearanceValue = $product->getAttributeText('clearance');
            if($clearanceValue === "Yes"){
                $clearance = true;
            }
        } catch(\Error $error){
            $clearance = false;
        }
        
        $storeCode = $this->_storeManager->getStore()->getCode();

        if(!$this->_customerSession->isLoggedIn() && ($isOnSale || $clearance)) 
        {
            if($storeCode == self::CANADA){
                $pricesArray = $this->_pricesManagement->getPricesListArray($productId, PricesLink::SALE_PRICE_ONLINE_CANADA);
            } else {
                $pricesArray = $this->_pricesManagement->getPricesListArray($productId, PricesLink::SALE_PRICE_ONLINE_USA);
            }
        } elseif(!$this->_customerSession->isLoggedIn())
        {
            if($storeCode == self::CANADA){
                $pricesArray = $this->_pricesManagement->getPricesListArray($productId, PricesLink::ONLINE_PRICE_CANADA);
            } else {
                $pricesArray = $this->_pricesManagement->getPricesListArray($productId, PricesLink::ONLINE_PRICE_USA);
            }
        } elseif($this->_customerSession->isLoggedIn() && ($isOnSale || $clearance))
        {
            if($storeCode == self::CANADA){
                $pricesArray = $this->_pricesManagement->getPricesListArray($productId, PricesLink::SALE_PRICE_CANADA);
            } else {
                $pricesArray = $this->_pricesManagement->getPricesListArray($productId, PricesLink::SALE_PRICE_USA);
            }
        } elseif($this->_customerSession->isLoggedIn())
        {
            if($storeCode == self::CANADA){
                $pricesArray = $this->_pricesManagement->getPricesListArray($productId, PricesLink::NET_PRICE_CANADA);
            } else {
                $pricesArray = $this->_pricesManagement->getPricesListArray($productId, PricesLink::NET_PRICE_USA);
            }
        }

        $extensionAttributes = $product->getExtensionAttributes();
        $extensionAttributes->setPrices($pricesArray);
        $product->setExtensionAttributes($extensionAttributes);

        return $product;
    }

    /**
     * Get Prices of product
     *
     * @param ProductRepositoryInterface $subject
     * @param ProductInterface $product
     * @return ProductInterface
     */
    public function afterGetById(ProductRepositoryInterface $subject, ProductInterface $product): ProductInterface
    {
        $productId = $product->getIdBySku($product->getSku());

        $pricesArray = [];

        // Product attributes
        $isOnSale = false;
        $clearance = false;
        
        // Try to get on sale value
        try{
            $isOnSaleValue = $product->getAttributeText('on_sale');
            if($isOnSaleValue === "Yes") {
                $isOnSale = true;
            }
        } catch(\Error $error){
            $isOnSale = false;
        }

        // Try to get clearance value
        try{
            $clearanceValue = $product->getAttributeText('clearance');
            if($clearanceValue === "Yes") {
                $clearance = true;
            }
        } catch(\Error $error){
            $clearance = false;
        }
        
        $storeCode = $this->_storeManager->getStore()->getCode();

        if(!$this->_customerSession->isLoggedIn() && ($isOnSale || $clearance)) 
        {
            $this->_logger->info('NO login y soy on sale o clearance');
            if($storeCode == self::CANADA){
                $pricesArray = $this->_pricesManagement->getPricesListArray($productId, PricesLink::SALE_PRICE_ONLINE_CANADA);
            } else {
                $pricesArray = $this->_pricesManagement->getPricesListArray($productId, PricesLink::SALE_PRICE_ONLINE_USA);
            }
        } elseif(!$this->_customerSession->isLoggedIn())
        {
            $this->_logger->info('NO LOGIN');
            if($storeCode == self::CANADA){
                $pricesArray = $this->_pricesManagement->getPricesListArray($productId, PricesLink::ONLINE_PRICE_CANADA);
            } else {
                $this->_logger->info('> USA');
                $pricesArray = $this->_pricesManagement->getPricesListArray($productId, PricesLink::ONLINE_PRICE_USA);
            }
        } elseif($this->_customerSession->isLoggedIn() && ($isOnSale || $clearance))
        {
            $this->_logger->info('LOGIN y soy on sale o clearance');
            if($storeCode == self::CANADA){
                $pricesArray = $this->_pricesManagement->getPricesListArray($productId, PricesLink::SALE_PRICE_CANADA);
            } else {
                $pricesArray = $this->_pricesManagement->getPricesListArray($productId, PricesLink::SALE_PRICE_USA);
            }
        } elseif($this->_customerSession->isLoggedIn())
        {
            $this->_logger->info('LOGIN');
            if($storeCode == self::CANADA){
                $pricesArray = $this->_pricesManagement->getPricesListArray($productId, PricesLink::NET_PRICE_CANADA);
            } else {
                $pricesArray = $this->_pricesManagement->getPricesListArray($productId, PricesLink::NET_PRICE_USA);
            }
        }

        $this->_logger->info('PRODUCT '.$productId.' PRICES', ['return'=>$pricesArray]);

        foreach ($pricesArray as $price)
        {
            $this->_logger->info('min quantity: ' . $price->getMinQuantity());
            $this->_logger->info('unit price: ' . $price->getUnitPrice());
        }

        $extensionAttributes = $product->getExtensionAttributes();
        $extensionAttributes->setPrices($pricesArray);
        $product->setExtensionAttributes($extensionAttributes);

        return $product;
    }
}