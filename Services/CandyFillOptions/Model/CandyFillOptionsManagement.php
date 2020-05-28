<?php
namespace Services\CandyFillOptions\Model;

class CandyFillOptionsManagement
{
    const SKU = 'sku';

    protected $_candyFillOptionsRepository;
    protected $_candyFillOptionsPricesRepository;
    protected $_candyFillOptionsCollection;
    protected $_candyFillOptionsExtensionFactory;
    protected $_searchCriteriaBuilder;
    protected $_filterBuilder;

    public function __construct(
        \Services\CandyFillOptions\Api\CandyFillOptionsRepositoryInterface $candyFillOptionsRepository,
        \Services\CandyFillOptions\Api\CandyFillOptionsPricesRepositoryInterface $candyFillOptionsPricesRepository,
        \Services\CandyFillOptions\Model\ResourceModel\CandyFillOptions\CollectionFactory $candyFillOptionsCollection,
        \Services\CandyFillOptions\Api\Data\CandyFillOptionsExtensionFactory $candyFillOptionsExtensionFactory,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder
    ) 
    {
        $this->_candyFillOptionsRepository       = $candyFillOptionsRepository;
        $this->_candyFillOptionsPricesRepository = $candyFillOptionsPricesRepository;
        $this->_candyFillOptionsCollection       = $candyFillOptionsCollection;
        $this->_candyFillOptionsExtensionFactory = $candyFillOptionsExtensionFactory;
        $this->_searchCriteriaBuilder            = $searchCriteriaBuilder;
        $this->_filterBuilder                    = $filterBuilder;
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
                        ->setField(self::SKU)
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