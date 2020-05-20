<?php

namespace ConfettiInserts\Manager\Model;

use Exception;
use ConfettiInserts\Manager\Api\Data\ConfettiInsertsInterface;
use ConfettiInserts\Manager\Api\Data\ConfettiInsertsSearchResultsInterface;
use ConfettiInserts\Manager\Api\Data\ConfettiInsertsSearchResultsInterfaceFactory;
use ConfettiInserts\Manager\Api\ConfettiInsertsRepositoryInterface;
use ConfettiInserts\Manager\Model\ConfettiInsertsFactory;
use ConfettiInserts\Manager\Model\ResourceModel\ConfettiInserts as ResourceModelConfettiInserts;
use ConfettiInserts\Manager\Model\ResourceModel\ConfettiInserts\Collection;
use ConfettiInserts\Manager\Model\ResourceModel\ConfettiInserts\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class ConfettiInsertsRepository
 */
class ConfettiInsertsRepository implements ConfettiInsertsRepositoryInterface
{

    /**
     * @var ConfettiInsertsFactory
     */
    private $_confettiInsertsFactory;

    /**
     * @var ResourceModelConfettiInserts
     */
    private $_resourceModelConfettiInserts;

    /**
     * @var CollectionFactory
     */
    private $_confettiInsertsCollectionFactory;

    /**
     * @var ConfettiInsertsSearchResultsInterfaceFactory
     */
    private $_confettiInsertsSearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    /**
     * ConfettiInsertsRepository constructor.
     *
     * @param ConfettiInsertsFactory $confettiInsertsFactory
     * @param ResourceModelConfettiInserts $resourceModelConfettiInserts
     * @param CollectionFactory $confettiInsertsCollectionFactory
     * @param ConfettiInsertsSearchResultsInterfaceFactory $confettiInsertsSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        ConfettiInsertsFactory $confettiInsertsFactory,
        ResourceModelConfettiInserts $resourceModelConfettiInserts,
        CollectionFactory $confettiInsertsCollectionFactory,
        ConfettiInsertsSearchResultsInterfaceFactory $confettiInsertsSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_confettiInsertsFactory                       = $confettiInsertsFactory;
        $this->_resourceModelConfettiInserts                 = $resourceModelConfettiInserts;
        $this->_confettiInsertsCollectionFactory             = $confettiInsertsCollectionFactory;
        $this->_confettiInsertsSearchResultsInterfaceFactory = $confettiInsertsSearchResultsInterfaceFactory;
        $this->_collectionProcessor                          = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor             = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($sku, $name, $img, $subcategory)
    {
        $confettiInserts = $this->_confettiInsertsFactory->create();
        $confettiInserts = $confettiInserts->load($sku, 'sku');
        if (!$confettiInserts->getId()) {
            $confettiInserts = $this->_confettiInsertsFactory->create();
        }
        $confettiInserts->setsku($sku);
        $confettiInserts->setName($name);
        $confettiInserts->setImg($img);
        $confettiInserts->setSubcategory($subcategory);
        $this->_resourceModelConfettiInserts->save($confettiInserts);
        return $confettiInserts;
    }

    /**
     * @inheritdoc
     */
    public function getById($confettiInsertsId)
    {
        return $this->get($confettiInsertsId);
    }

    /**
     * @inheritdoc
     */
    public function deleteById($confettiInsertsId)
    {
        $confettiInsert = $this->getById($confettiInsertsId);
        return $this->delete($confettiInsert);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->_confettiInsertsCollectionFactory->create();

        $this->_extensionAttributesJoinProcessor->process($collection, ConfettiInsertsInterface::class);
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var ConfettiInsertsSearchResultsInterface $searchResults */
        $searchResults = $this->_confettiInsertsSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}