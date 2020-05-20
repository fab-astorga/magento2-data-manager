<?php

namespace HotChocolate\Manager\Model;

use Exception;
use HotChocolate\Manager\Api\Data\HotChocolateInterface;
use HotChocolate\Manager\Api\Data\HotChocolateSearchResultsInterface;
use HotChocolate\Manager\Api\Data\HotChocolateSearchResultsInterfaceFactory;
use HotChocolate\Manager\Api\HotChocolateRepositoryInterface;
use HotChocolate\Manager\Model\HotChocolateFactory;
use HotChocolate\Manager\Model\ResourceModel\HotChocolate as ResourceModelHotChocolate;
use HotChocolate\Manager\Model\ResourceModel\HotChocolate\Collection;
use HotChocolate\Manager\Model\ResourceModel\HotChocolate\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class HotChocolateRepository
 */
class HotChocolateRepository implements HotChocolateRepositoryInterface
{

    /**
     * @var HotChocolateFactory
     */
    private $_hotChocolateFactory;

    /**
     * @var ResourceModelHotChocolate
     */
    private $_resourceModelHotChocolate;

    /**
     * @var CollectionFactory
     */
    private $_hotChocolateCollectionFactory;

    /**
     * @var HotChocolateSearchResultsInterfaceFactory
     */
    private $_hotChocolateSearchResultsInterfaceFactory;

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
     * @param HotChocolateFactory $hotChocolateFactory
     * @param ResourceModelHotChocolate $resourceModelHotChocolate
     * @param CollectionFactory $hotChocolateCollectionFactory
     * @param HotChocolateSearchResultsInterfaceFactory $hotChocolateSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        HotChocolateFactory $hotChocolateFactory,
        ResourceModelHotChocolate $resourceModelHotChocolate,
        CollectionFactory $hotChocolateCollectionFactory,
        HotChocolateSearchResultsInterfaceFactory $hotChocolateSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_hotChocolateFactory                          = $hotChocolateFactory;
        $this->_resourceModelHotChocolate                    = $resourceModelHotChocolate;
        $this->_hotChocolateCollectionFactory                = $hotChocolateCollectionFactory;
        $this->_hotChocolateSearchResultsInterfaceFactory    = $hotChocolateSearchResultsInterfaceFactory;
        $this->_collectionProcessor                          = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor             = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($sku, $salesDescription, $img, $name, $purchaseDescription)
    {
        $hotChocolate = $this->_hotChocolateFactory->create();
        $hotChocolate = $hotChocolate->load($sku, 'sku');
        if (!$hotChocolate->getId()) {
            $hotChocolate = $this->_hotChocolateFactory->create();
        }
        $hotChocolate->setsku($sku);
        $hotChocolate->setName($name);
        $hotChocolate->setImg($img);
        $hotChocolate->setSalesDescription($salesDescription);
        $hotChocolate->setPurchaseDescription($purchaseDescription);
        $this->_resourceModelHotChocolate->save($hotChocolate);
        return $hotChocolate;
    }

    /**
     * @inheritdoc
     */
    public function getById($hotChocolateId)
    {
        return $this->get($hotChocolateId);
    }

    /**
     * @inheritdoc
     */
    public function deleteById($hotChocolateId)
    {
        $confettiInsert = $this->getById($hotChocolateId);
        return $this->delete($confettiInsert);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->_hotChocolateCollectionFactory->create();

        $this->_extensionAttributesJoinProcessor->process($collection, HotChocolateInterface::class);
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var HotChocolateSearchResultsInterface $searchResults */
        $searchResults = $this->_hotChocolateSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}