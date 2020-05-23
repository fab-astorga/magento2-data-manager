<?php
namespace Services\GlitterInserts\Model;

use Magento\Framework\Exception\CouldNotSaveException;

class GlitterInsertsManagement
{
    const GLITTER_INSERTS_FILE                 = 'csv/glitter_inserts.csv';
    const GLITTER_METALLIC_INSERTS_PRICES_FILE = 'csv/glitter_metallic_inserts_prices.csv';
    const SKU                                  = 0;
    const NAME                                 = 1;
    const IMG                                  = 2;
    const TYPE                                 = 3;
    const CURRENCY                             = 1;
    const PRICE_LEVEL                          = 2;
    const MIN_QUANTITY                         = 3;
    const UNIT_PRICE                           = 4;
    const GMIP_ID                              = 5;

    protected $_glitterInsertsRepository;
    protected $_glitterMetallicInsertsPricesRepository;
    protected $_glitterInsertsCollection;
    protected $_glitterInsertsExtensionFactory;
    protected $_searchCriteriaBuilder;
    protected $_filterBuilder;
    protected $_helper;
    protected $_logger;

    public function __construct(
        \Services\GlitterInserts\Api\GlitterInsertsRepositoryInterface $glitterInsertsRepository,
        \Services\GlitterInserts\Api\GlitterMetallicInsertsPricesRepositoryInterface $glitterMetallicInsertsPricesRepository,
        \Services\GlitterInserts\Model\ResourceModel\GlitterInserts\CollectionFactory $glitterInsertsCollection,
        \Services\GlitterInserts\Api\Data\GlitterInsertsExtensionFactory $glitterInsertsExtensionFactory,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Services\PmsColors\Helper\Data $helper,
        \File\CustomLog\Logger\Logger $logger
    ) 
    {
        $this->_glitterInsertsRepository       = $glitterInsertsRepository;
        $this->_glitterMetallicInsertsPricesRepository = $glitterMetallicInsertsPricesRepository;
        $this->_glitterInsertsCollection       = $glitterInsertsCollection;
        $this->_glitterInsertsExtensionFactory = $glitterInsertsExtensionFactory;
        $this->_searchCriteriaBuilder           = $searchCriteriaBuilder;
        $this->_filterBuilder                   = $filterBuilder;
        $this->_helper                          = $helper;
        $this->_logger                          = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function importGlitterInsertsFromCsv() 
    {
        try { 
            $this->_glitterInsertsRepository->delete();  
            $glitterInserts = $this->_helper->parseCsvFile(self::GLITTER_INSERTS_FILE);
            foreach ($glitterInserts as $glitterInsert) 
            {                 
                $this->_glitterInsertsRepository->save(
                    $glitterInsert[self::SKU],
                    $glitterInsert[self::NAME],
                    $glitterInsert[self::IMG],
                    $glitterInsert[self::TYPE]
                );
            }
            $this->_glitterMetallicInsertsPricesRepository->delete();  
            $glitterMetallicInsertsPrices = $this->_helper->parseCsvFile(
                                                self::GLITTER_METALLIC_INSERTS_PRICES_FILE);

            foreach ($glitterMetallicInsertsPrices as $glitterMetallicInsertsPrice) 
            { 
                $this->_glitterMetallicInsertsPricesRepository->save(
                    $glitterMetallicInsertsPrice[self::GMIP_ID],
                    $glitterMetallicInsertsPrice[self::SKU],
                    $glitterMetallicInsertsPrice[self::CURRENCY],
                    $glitterMetallicInsertsPrice[self::PRICE_LEVEL],
                    $glitterMetallicInsertsPrice[self::MIN_QUANTITY],
                    $glitterMetallicInsertsPrice[self::UNIT_PRICE]
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
    public function getGlitterInserts()
    {
        $collection = $this->_glitterInsertsCollection->create();

        foreach ($collection as $glitterInsert)
        {
            $filter[] = $this->_filterBuilder
                        ->setField('sku')
                        ->setValue( $glitterInsert->getSku() )
                        ->setConditionType('eq')
                        ->create();
            
            $searchCriteria = $this->_searchCriteriaBuilder->addFilters($filter);
            $searchResults = $this->_glitterMetallicInsertsPricesRepository->getList($searchCriteria->create());
            $glitterMetallicInsertsPrices = $searchResults->getItems();

            $extensionAttributes = $glitterInsert->getExtensionAttributes();
            $glitterInsertsExtension = $extensionAttributes ? $extensionAttributes : $this->_glitterInsertsExtensionFactory->create();
            $glitterInsertsExtension->setGlitterMetallicInsertsPrices($glitterMetallicInsertsPrices);
            $glitterInsert->setExtensionAttributes($glitterInsertsExtension);
        }

        return $collection->getData();
    }
}