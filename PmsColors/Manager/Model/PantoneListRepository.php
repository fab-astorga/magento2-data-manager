<?php

namespace PmsColors\Manager\Model;

use Exception;
use PmsColors\Manager\Api\Data\PantoneListInterface;
use PmsColors\Manager\Api\Data\PantoneListSearchResultsInterface;
use PmsColors\Manager\Api\Data\PantoneListSearchResultsInterfaceFactory;
use PmsColors\Manager\Api\PantoneListRepositoryInterface;
use PmsColors\Manager\Model\PantoneListFactory;
use PmsColors\Manager\Model\ResourceModel\PantoneList as ResourceModelPantoneList;
use PmsColors\Manager\Model\ResourceModel\PantoneList\Collection;
use PmsColors\Manager\Model\ResourceModel\PantoneList\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class PantoneListRepository
 */
class PantoneListRepository implements PantoneListRepositoryInterface
{

    /**
     * @var PantoneListFactory
     */
    private $_pantoneListFactory;

    /**
     * @var ResourceModelPantoneList
     */
    private $_resourceModelPantoneList;

    /**
     * @var CollectionFactory
     */
    private $_pantoneListCollectionFactory;

    /**
     * @var PantoneListSearchResultsInterfaceFactory
     */
    private $_pantoneListSearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    /**
     * PantoneListRepository constructor.
     *
     * @param PantoneListFactory $pantoneListFactory
     * @param ResourceModelPantoneList $resourceModelPantoneList
     * @param CollectionFactory $pantoneListCollectionFactory
     * @param PantoneListSearchResultsInterfaceFactory $pantoneListSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        PantoneListFactory $pantoneListFactory,
        ResourceModelPantoneList $resourceModelPantoneList,
        CollectionFactory $pantoneListCollectionFactory,
        PantoneListSearchResultsInterfaceFactory $pantoneListSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_pantoneListFactory                       = $pantoneListFactory;
        $this->_resourceModelPantoneList                 = $resourceModelPantoneList;
        $this->_pantoneListCollectionFactory             = $pantoneListCollectionFactory;
        $this->_pantoneListSearchResultsInterfaceFactory = $pantoneListSearchResultsInterfaceFactory;
        $this->_collectionProcessor                      = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor         = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($internalId, $name, $hexCode, $r, $g, $b)
    {
        $pmsColor = $this->_pantoneListFactory->create();
        $pmsColor->setInternalId($internalId);
        $pmsColor->setName($name);
        $pmsColor->setHexCode($hexCode);
        $pmsColor->setR($r);
        $pmsColor->setG($g);
        $pmsColor->setB($b);
        $this->_resourceModelPantoneList->save($pmsColor);
        return $pmsColor;
    }

    /**
     * @inheritdoc
     */
    public function getById($pmsColorId)
    {
        return $this->get($pmsColorId);
    }

    /**
     * @inheritdoc
     */
    public function deleteById($pmsColorId)
    {
        $pmsColor = $this->getById($pmsColorId);
        return $this->delete($pmsColor);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->_pantoneListCollectionFactory->create();

        $this->_extensionAttributesJoinProcessor->process($collection, PantoneListInterface::class);
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var PantoneListSearchResultsInterface $searchResults */
        $searchResults = $this->_pantoneListSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}