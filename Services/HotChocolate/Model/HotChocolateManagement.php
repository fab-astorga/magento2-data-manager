<?php
namespace Services\HotChocolate\Model;

use Magento\Framework\Exception\CouldNotSaveException;

class HotChocolateManagement
{
    const HOT_CHOCOLATE_FILE           = 'csv/hot_chocolate.csv';
    const HOT_CHOCOLATE_PRICES_FILE    = 'csv/hot_chocolate_prices.csv';
    const SKU                          = 0;
    const SALES_DESCRIPTION            = 1;
    const IMG                          = 2;
    const NAME                         = 3;
    const PURCHASE_DESCRIPTION         = 4;
    const CURRENCY                     = 1;
    const PRICE_LEVEL                  = 2;
    const MIN_QUANTITY                 = 3;
    const UNIT_PRICE                   = 4;
    const ID                           = 5;

    protected $_hotChocolateRepository;
    protected $_hotChocolatePricesRepository;
    protected $_hotChocolateCollection;
    protected $_hotChocolateExtensionFactory;
    protected $_searchCriteriaBuilder;
    protected $_filterBuilder;
    protected $_helper;
    protected $_logger;

    public function __construct(
        \Services\HotChocolate\Api\HotChocolateRepositoryInterface $hotChocolateRepository,
        \Services\HotChocolate\Api\HotChocolatePricesRepositoryInterface $hotChocolatePricesRepository,
        \Services\HotChocolate\Model\ResourceModel\HotChocolate\CollectionFactory $hotChocolateCollection,
        \Services\HotChocolate\Api\Data\HotChocolateExtensionFactory $hotChocolateExtensionFactory,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Services\PmsColors\Helper\Data $helper,
        \File\CustomLog\Logger\Logger $logger
    ) 
    {
        $this->_hotChocolateRepository          = $hotChocolateRepository;
        $this->_hotChocolatePricesRepository    = $hotChocolatePricesRepository;
        $this->_hotChocolateCollection          = $hotChocolateCollection;
        $this->_hotChocolateExtensionFactory    = $hotChocolateExtensionFactory;
        $this->_searchCriteriaBuilder           = $searchCriteriaBuilder;
        $this->_filterBuilder                   = $filterBuilder;
        $this->_helper                          = $helper;
        $this->_logger                          = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function importHotChocolateFromCsv() 
    {
        try { 
            $this->_hotChocolateRepository->delete();  
            $hotChocolate = $this->_helper->parseCsvFile(self::HOT_CHOCOLATE_FILE);
            foreach ($hotChocolate as $hc) 
            {                 
                $this->_hotChocolateRepository->save(
                    $hc[self::ID],
                    $hc[self::SKU],
                    $hc[self::SALES_DESCRIPTION],
                    $hc[self::IMG],
                    $hc[self::NAME],
                    $hc[self::PURCHASE_DESCRIPTION]                   
                );
            }
            $this->_hotChocolatePricesRepository->delete();  
            $hotChocolatePrices = $this->_helper->parseCsvFile(self::HOT_CHOCOLATE_PRICES_FILE);
            foreach ($hotChocolatePrices as $hotChocolatePrice) 
            { 
                $this->_hotChocolatePricesRepository->save(
                    $hotChocolatePrice[self::ID],
                    $hotChocolatePrice[self::SKU],
                    $hotChocolatePrice[self::CURRENCY],
                    $hotChocolatePrice[self::PRICE_LEVEL],
                    $hotChocolatePrice[self::MIN_QUANTITY],
                    $hotChocolatePrice[self::UNIT_PRICE]
                );
            }
            return true;

        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getHotChocolate()
    {
        $collection = $this->_hotChocolateCollection->create();

        foreach ($collection as $hotChocolate)
        {
            $filter[] = $this->_filterBuilder
                        ->setField('sku')
                        ->setValue( $hotChocolate->getSku() )
                        ->setConditionType('eq')
                        ->create();
            
            $searchCriteria = $this->_searchCriteriaBuilder->addFilters($filter);
            $searchResults = $this->_hotChocolatePricesRepository->getList($searchCriteria->create());
            $hotChocolatePrices = $searchResults->getItems();

            $extensionAttributes = $hotChocolate->getExtensionAttributes();
            $hotChocolateExtension = $extensionAttributes ? $extensionAttributes : $this->_hotChocolateExtensionFactory->create();
            $hotChocolateExtension->setHotChocolatePrices($hotChocolatePrices);
            $hotChocolate->setExtensionAttributes($hotChocolateExtension);
        }

        return $collection->getData();
    }
}