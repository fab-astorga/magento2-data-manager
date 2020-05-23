<?php

namespace Services\GlitterInserts\Model;

use Exception;
use Services\GlitterInserts\Api\Data\GlitterInsertsInterface;
use Services\GlitterInserts\Api\Data\GlitterInsertsSearchResultsInterface;
use Services\GlitterInserts\Api\Data\GlitterInsertsSearchResultsInterfaceFactory;
use Services\GlitterInserts\Api\GlitterInsertsRepositoryInterface;
use Services\GlitterInserts\Model\GlitterInsertsFactory;
use Services\GlitterInserts\Model\ResourceModel\GlitterInserts as ResourceModelGlitterInserts;
use Services\GlitterInserts\Model\ResourceModel\GlitterInserts\Collection;
use Services\GlitterInserts\Model\ResourceModel\GlitterInserts\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GlitterInsertsRepository
 */
class GlitterInsertsRepository implements GlitterInsertsRepositoryInterface
{

    /**
     * @var GlitterInsertsFactory
     */
    private $_glitterInsertsFactory;

    /**
     * @var ResourceModelGlitterInserts
     */
    private $_resourceModelGlitterInserts;

    /**
     * @var CollectionFactory
     */
    private $_glitterInsertsCollectionFactory;

    /**
     * @var GlitterInsertsSearchResultsInterfaceFactory
     */
    private $_glitterInsertsSearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    /**
     * GlitterInsertsRepository constructor.
     *
     * @param GlitterInsertsFactory $glitterInsertsFactory
     * @param ResourceModelGlitterInserts $resourceModelGlitterInserts
     * @param CollectionFactory $glitterInsertsCollectionFactory
     * @param GlitterInsertsSearchResultsInterfaceFactory $glitterInsertsSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        GlitterInsertsFactory $glitterInsertsFactory,
        ResourceModelGlitterInserts $resourceModelGlitterInserts,
        CollectionFactory $glitterInsertsCollectionFactory,
        GlitterInsertsSearchResultsInterfaceFactory $glitterInsertsSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_glitterInsertsFactory                       = $glitterInsertsFactory;
        $this->_resourceModelGlitterInserts                 = $resourceModelGlitterInserts;
        $this->_glitterInsertsCollectionFactory             = $glitterInsertsCollectionFactory;
        $this->_glitterInsertsSearchResultsInterfaceFactory = $glitterInsertsSearchResultsInterfaceFactory;
        $this->_collectionProcessor                          = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor             = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($sku, $name, $img, $type)
    {
        $glitterInserts = $this->_glitterInsertsFactory->create();
        $glitterInserts = $glitterInserts->load($sku, 'sku');
        if (!$glitterInserts->getId()) {
            $glitterInserts = $this->_glitterInsertsFactory->create();
        }
        $glitterInserts->setsku($sku);
        $glitterInserts->setName($name);
        $glitterInserts->setImg($img);
        $glitterInserts->setType($type);
        $this->_resourceModelGlitterInserts->save($glitterInserts);
        return $glitterInserts;
    }

    /**
     * @inheritdoc
     */
    public function getById($glitterInsertsId)
    {
        return $this->get($glitterInsertsId);
    }

    /**
     * @inheritdoc
     */
    public function deleteById($glitterInsertsId)
    {
        $glitterInsert = $this->getById($glitterInsertsId);
        return $this->delete($glitterInsert);
    }

    /**
     * @inheritdoc
     */
    public function delete()
    {
        try { 
            $collection = $this->_glitterInsertsCollectionFactory->create();
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
        $collection = $this->_glitterInsertsCollectionFactory->create();

        $this->_extensionAttributesJoinProcessor->process($collection, GlitterInsertsInterface::class);
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var GlitterInsertsSearchResultsInterface $searchResults */
        $searchResults = $this->_glitterInsertsSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}