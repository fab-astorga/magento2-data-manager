<?php
namespace Services\GlitterInserts\Model;

class GlitterInsertsManagement
{
    protected $_glitterMetallicInsertsPricesRepository;
    protected $_glitterInsertsCollection;
    protected $_glitterInsertsExtensionFactory;
    protected $_searchCriteriaBuilder;
    protected $_filterBuilder;

    public function __construct(
        \Services\GlitterInserts\Api\GlitterMetallicInsertsPricesRepositoryInterface $glitterMetallicInsertsPricesRepository,
        \Services\GlitterInserts\Model\ResourceModel\GlitterInserts\CollectionFactory $glitterInsertsCollection,
        \Services\GlitterInserts\Api\Data\GlitterInsertsExtensionFactory $glitterInsertsExtensionFactory,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder
    ) 
    {
        $this->_glitterMetallicInsertsPricesRepository = $glitterMetallicInsertsPricesRepository;
        $this->_glitterInsertsCollection               = $glitterInsertsCollection;
        $this->_glitterInsertsExtensionFactory         = $glitterInsertsExtensionFactory;
        $this->_searchCriteriaBuilder                  = $searchCriteriaBuilder;
        $this->_filterBuilder                          = $filterBuilder;
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