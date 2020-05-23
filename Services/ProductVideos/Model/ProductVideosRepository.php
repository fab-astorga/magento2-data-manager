<?php

namespace Services\ProductVideos\Model;

use Exception;
use Services\ProductVideos\Api\Data\ProductVideosInterface;
use Services\ProductVideos\Api\Data\ProductVideosSearchResultsInterface;
use Services\ProductVideos\Api\Data\ProductVideosSearchResultsInterfaceFactory;
use Services\ProductVideos\Api\ProductVideosRepositoryInterface;
use Services\ProductVideos\Model\ProductVideosFactory;
use Services\ProductVideos\Model\ResourceModel\ProductVideos as ResourceModelProductVideos;
use Services\ProductVideos\Model\ResourceModel\ProductVideos\Collection;
use Services\ProductVideos\Model\ResourceModel\ProductVideos\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class ProductVideosRepository
 */
class ProductVideosRepository implements ProductVideosRepositoryInterface
{

    /**
     * @var ProductVideosFactory
     */
    private $_productVideosFactory;

    /**
     * @var ResourceModelProductVideos
     */
    private $_resourceModelProductVideos;

    /**
     * @var CollectionFactory
     */
    private $_productVideosCollectionFactory;

    /**
     * @var ProductVideosSearchResultsInterfaceFactory
     */
    private $_productVideosSearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    /**
     * ProductVideosRepository constructor.
     *
     * @param ProductVideosFactory $productVideosFactory
     * @param ResourceModelProductVideos $resourceModelProductVideos
     * @param CollectionFactory $productVideosCollectionFactory
     * @param ProductVideosSearchResultsInterfaceFactory $productVideosSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        ProductVideosFactory $productVideosFactory,
        ResourceModelProductVideos $resourceModelProductVideos,
        CollectionFactory $productVideosCollectionFactory,
        ProductVideosSearchResultsInterfaceFactory $productVideosSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_productVideosFactory                       = $productVideosFactory;
        $this->_resourceModelProductVideos                 = $resourceModelProductVideos;
        $this->_productVideosCollectionFactory             = $productVideosCollectionFactory;
        $this->_productVideosSearchResultsInterfaceFactory = $productVideosSearchResultsInterfaceFactory;
        $this->_collectionProcessor                        = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor           = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($id, $name, $img, $video)
    {
        $productVideo = $this->_productVideosFactory->create();
        if (!$productVideo->getId()) {
            $productVideo = $this->_productVideosFactory->create();
        }
        $productVideo->setId($id);
        $productVideo->setName($name);
        $productVideo->setImg($img);
        $productVideo->setVideo($video);
        $this->_resourceModelProductVideos->save($productVideo);
        return $productVideo;
    }

    /**
     * @inheritdoc
     */
    public function getById($productVideoId)
    {
        return $this->get($productVideoId);
    }

    /**
     * @inheritdoc
     */
    public function deleteById($productVideoId)
    {
        $productVideo = $this->getById($productVideoId);
        return $this->delete($productVideo);
    }

    /**
     * @inheritdoc
     */
    public function delete()
    {
        try { 
            $collection = $this->_productVideosCollectionFactory->create();
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
        $collection = $this->_productVideosCollectionFactory->create();

        $this->_extensionAttributesJoinProcessor->process($collection, ProductVideosInterface::class);
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var ProductVideosSearchResultsInterface $searchResults */
        $searchResults = $this->_productVideosSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}