<?php
namespace ConfettiInserts\Manager\Model;

use Magento\Framework\Exception\CouldNotSaveException;

class ConfettiInsertsManagement
{
    const CONFETTI_INSERTS_FILE        = 'csv/confetti_inserts.csv';
    const CONFETTI_INSERTS_PRICES_FILE = 'csv/confetti_inserts_prices.csv';
    const SKU                          = 0;
    const IMG                          = 1;
    const NAME                         = 2;
    const SUBCATEGORY                  = 3;
    const CURRENCY                     = 1;
    const PRICE_LEVEL                  = 2;
    const MIN_QUANTITY                 = 3;
    const UNIT_PRICE                   = 4;
    const ID                           = 5;

    protected $_confettiInsertsRepository;
    protected $_confettiInsertsPricesRepository;
    protected $_confettiInsertsCollection;
    protected $_confettiInsertsExtensionFactory;
    protected $_searchCriteriaBuilder;
    protected $_filterBuilder;
    protected $_helper;
    protected $_logger;

    public function __construct(
        \ConfettiInserts\Manager\Api\ConfettiInsertsRepositoryInterface $confettiInsertsRepository,
        \ConfettiInserts\Manager\Api\ConfettiInsertsPricesRepositoryInterface $confettiInsertsPricesRepository,
        \ConfettiInserts\Manager\Model\ResourceModel\ConfettiInserts\CollectionFactory $confettiInsertsCollection,
        \ConfettiInserts\Manager\Api\Data\ConfettiInsertsExtensionFactory $confettiInsertsExtensionFactory,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \PmsColors\Manager\Helper\Data $helper,
        \File\CustomLog\Logger\Logger $logger
    ) 
    {
        $this->_confettiInsertsRepository       = $confettiInsertsRepository;
        $this->_confettiInsertsPricesRepository = $confettiInsertsPricesRepository;
        $this->_confettiInsertsCollection       = $confettiInsertsCollection;
        $this->_confettiInsertsExtensionFactory = $confettiInsertsExtensionFactory;
        $this->_searchCriteriaBuilder           = $searchCriteriaBuilder;
        $this->_filterBuilder                   = $filterBuilder;
        $this->_helper                          = $helper;
        $this->_logger                          = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function importConfettiInsertsFromCsv() 
    {
        try { 
            $confettiInserts = $this->_helper->parseCsvFile(self::CONFETTI_INSERTS_FILE);
            foreach ($confettiInserts as $confettiInsert) 
            { 
                $this->_logger->info( 'sku: ' . $confettiInsert[self::SKU] );
                
                $this->_confettiInsertsRepository->save(
                    $confettiInsert[self::SKU],
                    $confettiInsert[self::NAME],
                    $confettiInsert[self::IMG],
                    $confettiInsert[self::SUBCATEGORY]
                );
            }
            $confettiInsertsPrices = $this->_helper->parseCsvFile(self::CONFETTI_INSERTS_PRICES_FILE);
            foreach ($confettiInsertsPrices as $confettiInsertsPrice) 
            { 
                $this->_confettiInsertsPricesRepository->save(
                    $confettiInsertsPrice[self::ID],
                    $confettiInsertsPrice[self::SKU],
                    $confettiInsertsPrice[self::CURRENCY],
                    $confettiInsertsPrice[self::PRICE_LEVEL],
                    $confettiInsertsPrice[self::MIN_QUANTITY],
                    $confettiInsertsPrice[self::UNIT_PRICE]
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
    public function getConfettiInserts()
    {
        $collection = $this->_confettiInsertsCollection->create();

        foreach ($collection as $confettiInsert)
        {
            $filter[] = $this->_filterBuilder
                        ->setField('sku')
                        ->setValue( $confettiInsert->getSku() )
                        ->setConditionType('eq')
                        ->create();
            
            $searchCriteria = $this->_searchCriteriaBuilder->addFilters($filter);
            $searchResults = $this->_confettiInsertsPricesRepository->getList($searchCriteria->create());
            $confettiInsertsPrices = $searchResults->getItems();

            $extensionAttributes = $confettiInsert->getExtensionAttributes();
            $confettiInsertsExtension = $extensionAttributes ? $extensionAttributes : $this->_confettiInsertsExtensionFactory->create();
            $confettiInsertsExtension->setConfettiInsertsPrices($confettiInsertsPrices);
            $confettiInsert->setExtensionAttributes($confettiInsertsExtension);
        }

        return $collection->getData();
    }
}