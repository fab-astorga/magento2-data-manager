<?php
namespace Items\ItemInformation\Model;

use Items\ItemInformation\Model\ResourceModel\Prices\PricesLink;
use Items\ItemInformation\Api\Data\PricesInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NotFoundException;

Class PricesManagement extends \Magento\Framework\Model\AbstractExtensibleModel implements \Items\ItemInformation\Api\PricesManagementInterface 
{
    const PRICES = 'prices';

    protected $_pricesFactory;
    protected $_pricesLink;
    protected $_priceListFactory;
    protected $_productRepository;
    protected $logger;

    public function __construct(
        \Items\ItemInformation\Model\PricesFactory $pricesFactory,
        \Items\ItemInformation\Model\ResourceModel\Prices\PricesLink $pricesLink,
        \Items\ItemInformation\Model\PriceListFactory $priceListFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \File\CustomLog\Logger\Logger $logger
    ) 
    {
        $this->_pricesFactory = $pricesFactory;
        $this->_pricesLink = $pricesLink;
        $this->_priceListFactory = $priceListFactory;
        $this->_productRepository = $productRepository;
        $this->logger = $logger;
    }

    /**
     * Returns true if the prices saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $pricesInformation
     * @return boolean
     */
    public function savePrices($product, $pricesInformation)
    {
        if(!empty($pricesInformation))
        {   
            try {
                $productId = $product->getIdBySku($product->getSku());

                /* Create new prices */
                $pricesLines = $pricesInformation[SELF::PRICES];
                foreach($pricesLines as $priceline) 
                {
                    $currency = $priceline['currency'];
                    $priceLevel = $priceline['price_level'];
                    $prices = $priceline['price_level_set'];
                    if($currency === 'CAD')
                    {
                        $priceTable = $this->getCanadianPriceTable($priceLevel);
                        $this->savePricesArray($priceTable ,$prices, $productId);
                    }
                    else if($currency === 'USA') 
                    {
                        $priceTable = $this->getUSAPriceTable($priceLevel);
                        $this->savePricesArray($priceTable ,$prices, $productId);
                    }
                }

                $this->setFinalProductPrice($product);
                return true;

            }catch(\Exception $error){
                throw new CouldNotSaveException(__('The product prices was unable to be saved. Error details: '.$error->getMessage()), $error);
            }
        } else {
            $this->logger->info('Nothing to do here');
        }
    }

    /**
     * Save prices array
     * @param string $priceTable
     * @param array $prices
     * @return boolean
     */
    public function savePricesArray($priceTable, $prices, $productId)
    {
        $pricesArray = [];
        foreach ($prices as $price)
        {
            $priceObject = $this->_pricesFactory->create();
            $priceObject->setItemId($productId);
            $priceObject->setMinQuantity((int)$price[PricesInterface::MIN_QUANTITY]);
            $priceObject->setUnitPrice((float)$price[PricesInterface::UNIT_PRICE]);
            array_push($pricesArray, $priceObject);
        }
        $this->_pricesLink->savePrices($productId, $pricesArray, $priceTable);
    }

    /**
     * Get USA Price Table
     * @param string $currency
     * @param array $priceLevel
     * @return string
     */
    public function getUSAPriceTable($priceLevel)
    {
        switch ($priceLevel) {
            case 'Net Price':
                return PricesLink::NET_PRICE_USA;
                break;
            case 'EQP':
                return PricesLink::EQP_USA;
                break;
            case 'Promotion':
                return PricesLink::PROMOTION_USA;
                break;
            case 'Retail Price':
                return PricesLink::RETAIL_PRICE_USA;
                break;
            case 'Sale Price':
                return PricesLink::SALE_PRICE_USA;
                break;
            case 'Sale Price Online':
                return PricesLink::SALE_PRICE_ONLINE_USA;
                break;
            case 'Sample Price':
                return PricesLink::SAMPLE_PRICE_USA;
                break;
            case 'Online Price':
                return PricesLink::ONLINE_PRICE_USA;
                break;
        }
    }

    /**
     * Get Canadian Price Table
     * @param string $currency
     * @param array $priceLevel
     * @return string
     */
    public function getCanadianPriceTable($priceLevel)
    {
        switch ($priceLevel) {
            case 'Net Price':
                return PricesLink::NET_PRICE_CANADA;
                break;
            case 'EQP':
                return PricesLink::EQP_CANADA;
                break;
            case 'Promotion':
                return PricesLink::PROMOTION_CANADA;
                break;
            case 'Retail Price':
                return PricesLink::RETAIL_PRICE_CANADA;
                break;
            case 'Sale Price':
                return PricesLink::SALE_PRICE_CANADA;
                break;
            case 'Sale Price Online':
                return PricesLink::SALE_PRICE_ONLINE_CANADA;
                break;
            case 'Sample Price':
                return PricesLink::SAMPLE_PRICE_CANADA;
                break;
            case 'Online Price':
                return PricesLink::ONLINE_PRICE_CANADA;
                break;
        }
    }


    /**
     * Get All Product Prices
     * @param int $productId
     * @return \Items\ItemInformation\Api\Data\PriceListInterface
     */
    public function getAllProductPrices($productId)
    {
        try {

            $prices = $this->_priceListFactory->create();
            
            /*** USA ***/
            $netPricesUsaArray = $this->getPricesListArray($productId, PricesLink::NET_PRICE_USA);
            $prices->setNetPriceUsa($netPricesUsaArray);

            $eqpUsaArray = $this->getPricesListArray($productId, PricesLink::EQP_USA);
            $prices->setEQPUsa($eqpUsaArray);

            $promotionUsaArray = $this->getPricesListArray($productId, PricesLink::PROMOTION_USA);
            $prices->setPromotionUsa($promotionUsaArray);

            $retailPricesUsaArray = $this->getPricesListArray($productId, PricesLink::RETAIL_PRICE_USA);
            $prices->setRetailPriceUsa($retailPricesUsaArray);

            $salePricesUsaArray = $this->getPricesListArray($productId, PricesLink::SALE_PRICE_USA);
            $prices->setSalePriceUsa($salePricesUsaArray);

            $salePricesOnlineUsaArray = $this->getPricesListArray($productId, PricesLink::SALE_PRICE_ONLINE_USA);
            $prices->setSalePriceOnlineUsa($salePricesOnlineUsaArray);

            $samplePricesUsaArray = $this->getPricesListArray($productId, PricesLink::SAMPLE_PRICE_USA);
            $prices->setSamplePriceUsa($samplePricesUsaArray);

            $onlinePricesUsaArray = $this->getPricesListArray($productId, PricesLink::ONLINE_PRICE_USA);
            $prices->setOnlinePriceUsa($onlinePricesUsaArray);

            /*** CANADA ***/
            $netPricesCanadaArray = $this->getPricesListArray($productId, PricesLink::NET_PRICE_CANADA);
            $prices->setNetPriceCanada($netPricesCanadaArray);

            $eqpCanadaArray = $this->getPricesListArray($productId, PricesLink::EQP_CANADA);
            $prices->setEQPCanada($eqpCanadaArray);

            $promotionCanadaArray = $this->getPricesListArray($productId, PricesLink::PROMOTION_CANADA);
            $prices->setPromotionCanada($promotionCanadaArray);

            $retailPricesCanadaArray = $this->getPricesListArray($productId, PricesLink::RETAIL_PRICE_CANADA);
            $prices->setRetailPriceCanada($retailPricesCanadaArray);

            $salePricesCanadaArray = $this->getPricesListArray($productId, PricesLink::SALE_PRICE_CANADA);
            $prices->setSalePriceCanada($salePricesCanadaArray);

            $salePricesOnlineCanadaArray = $this->getPricesListArray($productId, PricesLink::SALE_PRICE_ONLINE_CANADA);
            $prices->setSalePriceOnlineCanada($salePricesOnlineCanadaArray);

            $samplePricesCanadaArray = $this->getPricesListArray($productId, PricesLink::SAMPLE_PRICE_CANADA);
            $prices->setSamplePriceCanada($samplePricesCanadaArray);

            $onlinePricesCanadaArray = $this->getPricesListArray($productId, PricesLink::ONLINE_PRICE_CANADA);
            $prices->setOnlinePriceCanada($onlinePricesCanadaArray);

            return $prices;
        } catch(\Exception $error){
            throw new NotFoundException(__('There was an error with the prices search. Error details: '.$error->getMessage()), $error);
        }
    }

    /**
     * Get Prices List Array
     * @param int $productId
     * @param string $priceLevel
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getPricesListArray($productId, $priceLevel)
    {
        $prices =  $this->_pricesLink->getPricesByProductdId($productId, $priceLevel);
        $pricesArray = [];

        foreach ($prices as $price)
        {
            $priceObject = $this->_pricesFactory->create();
            $priceObject->setItemId($productId);
            $priceObject->setMinQuantity((int)$price[PricesInterface::MIN_QUANTITY]);
            $priceObject->setUnitPrice((float)$price[PricesInterface::UNIT_PRICE]);
            array_push($pricesArray, $priceObject);
        }
        // Order ASC
        usort($pricesArray, function($a, $b) {
            return $a->getMinQuantity() > $b->getMinQuantity() ? 1 : -1;
        });
        return $pricesArray;
    }


    /**
     * Set final product price (online price)
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @return boolean
     */
    public function setFinalProductPrice($product)
    {
        try {
            $onlinePrices = $this->getPricesListArray($product->getId(), PricesLink::ONLINE_PRICE_USA);

            if(count($onlinePrices) > 0)
            {
                $finalPrice = end($onlinePrices)->getUnitPrice();
                $product->setPrice($finalPrice);
                $this->_productRepository->save($product);
            } elseif (count($onlinePrices) == 0) 
            {
                $finalPrice = 0;
                $product->setPrice($finalPrice);
                $this->_productRepository->save($product);
            }
        }catch(\Exception $error) {
            throw new Exception(__('There was an error with the price. Error details: '.$error->getMessage()), $error);
        }
    }
}