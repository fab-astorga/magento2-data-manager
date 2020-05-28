<?php
namespace Services\ConfettiInserts\Model;

class ConfettiInsertsManagement
{
    protected $_confettiInsertsPricesRepository;
    protected $_confettiInsertsCollection;
    protected $_confettiInsertsExtensionFactory;
    protected $_searchCriteriaBuilder;
    protected $_filterBuilder;

    public function __construct(
        \Services\ConfettiInserts\Api\ConfettiInsertsPricesRepositoryInterface $confettiInsertsPricesRepository,
        \Services\ConfettiInserts\Model\ResourceModel\ConfettiInserts\CollectionFactory $confettiInsertsCollection,
        \Services\ConfettiInserts\Api\Data\ConfettiInsertsExtensionFactory $confettiInsertsExtensionFactory,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder
    ) 
    {
        $this->_confettiInsertsPricesRepository = $confettiInsertsPricesRepository;
        $this->_confettiInsertsCollection       = $confettiInsertsCollection;
        $this->_confettiInsertsExtensionFactory = $confettiInsertsExtensionFactory;
        $this->_searchCriteriaBuilder           = $searchCriteriaBuilder;
        $this->_filterBuilder                   = $filterBuilder;
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