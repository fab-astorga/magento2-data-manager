<?php
namespace Services\MetallicInserts\Model;

use Magento\Framework\Exception\CouldNotSaveException;

class MetallicInsertsManagement
{
    const METALLIC_INSERTS_FILE                = 'csv/metallic_inserts.csv';
    const GLITTER_METALLIC_INSERTS_PRICES_FILE = 'csv/glitter_metallic_inserts_prices.csv';
    const SKU                                  = 0;
    const NAME                                 = 1;
    const IMG                                  = 2;
    const CURRENCY                             = 1;
    const PRICE_LEVEL                          = 2;
    const MIN_QUANTITY                         = 3;
    const UNIT_PRICE                           = 4;
    const GMIP_ID                              = 5;

    protected $_metallicInsertsRepository;
    protected $_glitterMetallicInsertsPricesRepository;
    protected $_metallicInsertsCollection;
    protected $_metallicInsertsExtensionFactory;
    protected $_searchCriteriaBuilder;
    protected $_filterBuilder;
    protected $_helper;
    protected $_logger;

    public function __construct(
        \Services\MetallicInserts\Api\MetallicInsertsRepositoryInterface $metallicInsertsRepository,
        \Services\GlitterInserts\Api\GlitterMetallicInsertsPricesRepositoryInterface $glitterMetallicInsertsPricesRepository,
        \Services\MetallicInserts\Model\ResourceModel\MetallicInserts\CollectionFactory $metallicInsertsCollection,
        \Services\MetallicInserts\Api\Data\MetallicInsertsExtensionFactory $metallicInsertsExtensionFactory,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Services\PmsColors\Helper\Data $helper,
        \File\CustomLog\Logger\Logger $logger
    ) 
    {
        $this->_metallicInsertsRepository              = $metallicInsertsRepository;
        $this->_glitterMetallicInsertsPricesRepository = $glitterMetallicInsertsPricesRepository;
        $this->_metallicInsertsCollection              = $metallicInsertsCollection;
        $this->_metallicInsertsExtensionFactory        = $metallicInsertsExtensionFactory;
        $this->_searchCriteriaBuilder                  = $searchCriteriaBuilder;
        $this->_filterBuilder                          = $filterBuilder;
        $this->_helper                                 = $helper;
        $this->_logger                                 = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function importMetallicInsertsFromCsv() 
    {
        try { 
            $this->_metallicInsertsRepository->delete();  
            $metallicInserts = $this->_helper->parseCsvFile(self::METALLIC_INSERTS_FILE);
            foreach ($metallicInserts as $metallicInsert) 
            {                 
                $this->_metallicInsertsRepository->save(
                    $metallicInsert[self::SKU],
                    $metallicInsert[self::NAME],
                    $metallicInsert[self::IMG]
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
    public function getMetallicInserts()
    {
        $collection = $this->_metallicInsertsCollection->create();

        foreach ($collection as $metallicInsert)
        {
            $filter[] = $this->_filterBuilder
                        ->setField('sku')
                        ->setValue( $metallicInsert->getSku() )
                        ->setConditionType('eq')
                        ->create();
            
            $searchCriteria = $this->_searchCriteriaBuilder->addFilters($filter);
            $searchResults = $this->_glitterMetallicInsertsPricesRepository->getList($searchCriteria->create());
            $glitterMetallicInsertsPrices = $searchResults->getItems();

            $extensionAttributes = $metallicInsert->getExtensionAttributes();
            $metallicInsertExtension = $extensionAttributes ? $extensionAttributes : $this->_metallicInsertsExtensionFactory->create();
            $metallicInsertExtension->setGlitterMetallicInsertsPrices($glitterMetallicInsertsPrices);
            $metallicInsert->setExtensionAttributes($metallicInsertExtension);
        }

        return $collection->getData();
    }
}