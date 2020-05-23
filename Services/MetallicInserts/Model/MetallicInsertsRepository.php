<?php

namespace Services\MetallicInserts\Model;

use Exception;
use Services\MetallicInserts\Api\Data\MetallicInsertsInterface;
use Services\MetallicInserts\Api\Data\MetallicInsertsSearchResultsInterface;
use Services\MetallicInserts\Api\Data\MetallicInsertsSearchResultsInterfaceFactory;
use Services\MetallicInserts\Api\MetallicInsertsRepositoryInterface;
use Services\MetallicInserts\Model\MetallicInsertsFactory;
use Services\MetallicInserts\Model\ResourceModel\MetallicInserts as ResourceModelMetallicInserts;
use Services\MetallicInserts\Model\ResourceModel\MetallicInserts\Collection;
use Services\MetallicInserts\Model\ResourceModel\MetallicInserts\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class MetallicInsertsRepository
 */
class MetallicInsertsRepository implements MetallicInsertsRepositoryInterface
{

    /**
     * @var MetallicInsertsFactory
     */
    private $_metallicInsertsFactory;

    /**
     * @var ResourceModelMetallicInserts
     */
    private $_resourceModelMetallicInserts;

    /**
     * @var CollectionFactory
     */
    private $_metallicInsertsCollectionFactory;

    /**
     * @var MetallicInsertsSearchResultsInterfaceFactory
     */
    private $_metallicInsertsSearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    /**
     * MetallicInsertsRepository constructor.
     *
     * @param MetallicInsertsFactory $metallicInsertsFactory
     * @param ResourceModelMetallicInserts $resourceModelMetallicInserts
     * @param CollectionFactory $metallicInsertsCollectionFactory
     * @param MetallicInsertsSearchResultsInterfaceFactory $metallicInsertsSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        MetallicInsertsFactory $metallicInsertsFactory,
        ResourceModelMetallicInserts $resourceModelMetallicInserts,
        CollectionFactory $metallicInsertsCollectionFactory,
        MetallicInsertsSearchResultsInterfaceFactory $metallicInsertsSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_metallicInsertsFactory                       = $metallicInsertsFactory;
        $this->_resourceModelMetallicInserts                 = $resourceModelMetallicInserts;
        $this->_metallicInsertsCollectionFactory             = $metallicInsertsCollectionFactory;
        $this->_metallicInsertsSearchResultsInterfaceFactory = $metallicInsertsSearchResultsInterfaceFactory;
        $this->_collectionProcessor                          = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor             = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($sku, $name, $img)
    {
        $metallicInserts = $this->_metallicInsertsFactory->create();
        $metallicInserts = $metallicInserts->load($sku, 'sku');
        if (!$metallicInserts->getId()) {
            $metallicInserts = $this->_metallicInsertsFactory->create();
        }
        $metallicInserts->setsku($sku);
        $metallicInserts->setName($name);
        $metallicInserts->setImg($img);
        $this->_resourceModelMetallicInserts->save($metallicInserts);
        return $metallicInserts;
    }

    /**
     * @inheritdoc
     */
    public function getById($metallicInsertsId)
    {
        return $this->get($metallicInsertsId);
    }

    /**
     * @inheritdoc
     */
    public function deleteById($metallicInsertsId)
    {
        $metallicInsert = $this->getById($metallicInsertsId);
        return $this->delete($metallicInsert);
    }

    /**
     * @inheritdoc
     */
    public function delete()
    {
        try { 
            $collection = $this->_metallicInsertsCollectionFactory->create();
            if($collection->getSize() ) {
                $collection->walk('delete');
            }
            return true;

        } catch (\Exception $e) {
            throw new NoSuchEntityException(__($e));
        }
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->_metallicInsertsCollectionFactory->create();

        $this->_extensionAttributesJoinProcessor->process($collection, MetallicInsertsInterface::class);
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var MetallicInsertsSearchResultsInterface $searchResults */
        $searchResults = $this->_metallicInsertsSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}