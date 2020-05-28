<?php

namespace Services\HotChocolate\Model;

class HotChocolateManagement
{
    protected $_hotChocolatePricesRepository;
    protected $_hotChocolateCollection;
    protected $_hotChocolateExtensionFactory;
    protected $_searchCriteriaBuilder;
    protected $_filterBuilder;

    public function __construct(
        \Services\HotChocolate\Api\HotChocolatePricesRepositoryInterface $hotChocolatePricesRepository,
        \Services\HotChocolate\Model\ResourceModel\HotChocolate\CollectionFactory $hotChocolateCollection,
        \Services\HotChocolate\Api\Data\HotChocolateExtensionFactory $hotChocolateExtensionFactory,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder
    ) 
    {
        $this->_hotChocolatePricesRepository    = $hotChocolatePricesRepository;
        $this->_hotChocolateCollection          = $hotChocolateCollection;
        $this->_hotChocolateExtensionFactory    = $hotChocolateExtensionFactory;
        $this->_searchCriteriaBuilder           = $searchCriteriaBuilder;
        $this->_filterBuilder                   = $filterBuilder;
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