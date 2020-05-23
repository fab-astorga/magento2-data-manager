<?php
namespace Services\CandyFillOptions\Model;

use Magento\Framework\Exception\CouldNotSaveException;

class CandyFillOptionsManagement
{
    const CANDY_OPTIONS_FILE        = 'csv/candy_options.csv';
    const CANDY_OPTIONS_PRICES_FILE = 'csv/candy_options_prices.csv';
    const SKU         = 0;
    const SALES_DESCRIPTION                  = 1;
    const CATEGORY                      = 2;
    const NAME      = 3;
    const PURCHASE_DESCRIPTION                       = 4;
    const IMG                    = 5;
    const CFO_ID                   = 6;
    const CURRENCY                  = 1;
    const PRICE_LEVEL               = 2;
    const MIN_QUANTITY              = 3;
    const UNIT_PRICE                = 4;
    const CFOP_ID                   = 5;

    protected $_candyFillOptionsRepository;
    protected $_candyFillOptionsPricesRepository;
    protected $_candyFillOptionsCollection;
    protected $_candyFillOptionsExtensionFactory;
    protected $_searchCriteriaBuilder;
    protected $_filterBuilder;
    protected $_helper;
    protected $_logger;

    public function __construct(
        \Services\CandyFillOptions\Api\CandyFillOptionsRepositoryInterface $candyFillOptionsRepository,
        \Services\CandyFillOptions\Api\CandyFillOptionsPricesRepositoryInterface $candyFillOptionsPricesRepository,
        \Services\CandyFillOptions\Model\ResourceModel\CandyFillOptions\CollectionFactory $candyFillOptionsCollection,
        \Services\CandyFillOptions\Api\Data\CandyFillOptionsExtensionFactory $candyFillOptionsExtensionFactory,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Services\PmsColors\Helper\Data $helper,
        \File\CustomLog\Logger\Logger $logger
    ) 
    {
        $this->_candyFillOptionsRepository       = $candyFillOptionsRepository;
        $this->_candyFillOptionsPricesRepository = $candyFillOptionsPricesRepository;
        $this->_candyFillOptionsCollection       = $candyFillOptionsCollection;
        $this->_candyFillOptionsExtensionFactory = $candyFillOptionsExtensionFactory;
        $this->_searchCriteriaBuilder            = $searchCriteriaBuilder;
        $this->_filterBuilder                    = $filterBuilder;
        $this->_helper                           = $helper;
        $this->_logger                           = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function importCandyFillOptionsFromCsv() 
    {
        try { 
            $this->_candyFillOptionsRepository->delete();  
            $candyFillOptions = $this->_helper->parseCsvFile(self::CANDY_OPTIONS_FILE);
            foreach ($candyFillOptions as $candyOption) 
            {                 
                $this->_candyFillOptionsRepository->save(
                    $candyOption[self::CFO_ID],
                    $candyOption[self::SKU],
                    $candyOption[self::NAME],
                    $candyOption[self::IMG],
                    $candyOption[self::CATEGORY],
                    $candyOption[self::SALES_DESCRIPTION],
                    $candyOption[self::PURCHASE_DESCRIPTION]
                );
            }
            $this->_candyFillOptionsPricesRepository->delete();  
            $candyFillOptionsPrices = $this->_helper->parseCsvFile(self::CANDY_OPTIONS_PRICES_FILE);
            foreach ($candyFillOptionsPrices as $candyFillOptionsPrice) 
            { 
                $this->_candyFillOptionsPricesRepository->save(
                    $candyFillOptionsPrice[self::CFOP_ID],
                    $candyFillOptionsPrice[self::SKU],
                    $candyFillOptionsPrice[self::CURRENCY],
                    $candyFillOptionsPrice[self::PRICE_LEVEL],
                    $candyFillOptionsPrice[self::MIN_QUANTITY],
                    $candyFillOptionsPrice[self::UNIT_PRICE]
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
    public function getCandyFillOptions()
    {
        $collection = $this->_candyFillOptionsCollection->create();

        foreach ($collection as $candyOption)
        {
            $filter[] = $this->_filterBuilder
                        ->setField('sku')
                        ->setValue( $candyOption->getSku() )
                        ->setConditionType('eq')
                        ->create();
            
            $searchCriteria = $this->_searchCriteriaBuilder->addFilters($filter);
            $searchResults = $this->_candyFillOptionsPricesRepository->getList($searchCriteria->create());
            $candyFillOptionsPrices = $searchResults->getItems();

            $extensionAttributes = $candyOption->getExtensionAttributes();
            $candyFillOptionsExtension = $extensionAttributes ? $extensionAttributes : $this->_candyFillOptionsExtensionFactory->create();
            $candyFillOptionsExtension->setCandyFillOptionsPrices($candyFillOptionsPrices);
            $candyOption->setExtensionAttributes($candyFillOptionsExtension);
        }

        return $collection->getData();
    }
}