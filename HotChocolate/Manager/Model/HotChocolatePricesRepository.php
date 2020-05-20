<?php

namespace HotChocolate\Manager\Model;

use Exception;
use HotChocolate\Manager\Api\Data\HotChocolatePricesInterface;
use HotChocolate\Manager\Api\Data\HotChocolatePricesSearchResultsInterface;
use HotChocolate\Manager\Api\Data\HotChocolatePricesSearchResultsInterfaceFactory;
use HotChocolate\Manager\Api\HotChocolatePricesRepositoryInterface;
use HotChocolate\Manager\Model\HotChocolatePricesFactory;
use HotChocolate\Manager\Model\ResourceModel\HotChocolatePrices as ResourceModelHotChocolatePrices;
use HotChocolate\Manager\Model\ResourceModel\HotChocolatePrices\Collection;
use HotChocolate\Manager\Model\ResourceModel\HotChocolatePrices\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class HotChocolatePricesRepository
 */
class HotChocolatePricesRepository implements HotChocolatePricesRepositoryInterface
{

    /**
     * @var HotChocolatePricesFactory
     */
    private $_hotChocolatePricesFactory;

    /**
     * @var ResourceModelHotChocolatePrices
     */
    private $_resourceModelHotChocolatePrices;

    /**
     * @var CollectionFactory
     */
    private $_hotChocolatePricesCollectionFactory;

    /**
     * @var HotChocolatePricesSearchResultsInterfaceFactory
     */
    private $_hotChocolatePricesSearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    /**
     * HotChocolateRepository constructor.
     *
     * @param HotChocolatePricesFactory $hotChocolatePricesFactory
     * @param ResourceModelHotChocolatePrices $resourceModelHotChocolatePrices
     * @param CollectionFactory $hotChocolatePricesCollectionFactory
     * @param HotChocolatePricesSearchResultsInterfaceFactory $hotChocolatePricesSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        HotChocolatePricesFactory $hotChocolatePricesFactory,
        ResourceModelHotChocolatePrices $resourceModelHotChocolatePrices,
        CollectionFactory $hotChocolatePricesCollectionFactory,
        HotChocolatePricesSearchResultsInterfaceFactory $hotChocolatePricesSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_hotChocolatePricesFactory                       = $hotChocolatePricesFactory;
        $this->_resourceModelHotChocolatePrices                 = $resourceModelHotChocolatePrices;
        $this->_hotChocolatePricesCollectionFactory             = $hotChocolatePricesCollectionFactory;
        $this->_hotChocolatePricesSearchResultsInterfaceFactory = $hotChocolatePricesSearchResultsInterfaceFactory;
        $this->_collectionProcessor                                = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor                   = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($id, $sku, $currency, $priceLevel, $minQuantity, $unitPrice)
    {
        $hotChocolatePrices = $this->_hotChocolatePricesFactory->create();
        $hotChocolatePrices = $hotChocolatePrices->load($id, 'id');
        if (!$hotChocolatePrices->getId()) {
            $hotChocolatePrices = $this->_hotChocolatePricesFactory->create();
        }
        $hotChocolatePrices->setId($id);
        $hotChocolatePrices->setsku($sku);
        $hotChocolatePrices->setCurrency($currency);
        $hotChocolatePrices->setPriceLevel($priceLevel);
        $hotChocolatePrices->setMinQuantity($minQuantity);
        $hotChocolatePrices->setUnitPrice($unitPrice);
        $this->_resourceModelHotChocolatePrices->save($hotChocolatePrices);
        return $hotChocolatePrices;
    }

    /**
     * @inheritdoc
     */
    public function getById($hotChocolatePricesId)
    {
        return $this->get($hotChocolatePricesId);
    }

    /**
     * @inheritdoc
     */
    public function deleteById($hotChocolatePricesId)
    {
        $confettiInsertPrice = $this->getById($hotChocolatePricesId);
        return $this->delete($confettiInsertPrice);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->_hotChocolatePricesCollectionFactory->create();

        $this->_extensionAttributesJoinProcessor->process($collection, HotChocolatePricesInterface::class);
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var HotChocolatePricesSearchResultsInterface $searchResults */
        $searchResults = $this->_hotChocolatePricesSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}