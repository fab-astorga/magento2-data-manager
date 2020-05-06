<?php

namespace DistributorTools\StockArtLibrary\Model;

use Exception;
use DistributorTools\StockArtLibrary\Api\Data\StockArtCoverInterface;
use DistributorTools\StockArtLibrary\Api\Data\StockArtCoverSearchResultsInterface;
use DistributorTools\StockArtLibrary\Api\Data\StockArtCoverSearchResultsInterfaceFactory;
use DistributorTools\StockArtLibrary\Api\StockArtCoverRepositoryInterface;
use DistributorTools\StockArtLibrary\Model\StockArtCoverFactory;
use DistributorTools\StockArtLibrary\Model\ResourceModel\StockArtCover as ResourceModelStockArtCover;
use DistributorTools\StockArtLibrary\Model\ResourceModel\StockArtCover\Collection;
use DistributorTools\StockArtLibrary\Model\ResourceModel\StockArtCover\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class StockArtCoverRepository
 */
class StockArtCoverRepository implements StockArtCoverRepositoryInterface
{

    /**
     * @var StockArtCoverFactory
     */
    private $_stockArtCoverFactory;

    /**
     * @var ResourceModelStockArtCover
     */
    private $_resourceModelStockArtCover;

    /**
     * @var CollectionFactory
     */
    private $_stockArtCoverCollectionFactory;

    /**
     * @var StockArtCoverSearchResultsInterfaceFactory
     */
    private $_stockArtCoverSearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    /**
     * StockArtCoverRepository constructor.
     *
     * @param StockArtCoverFactory $stockArtCoverFactory
     * @param ResourceModelStockArtCover $resourceModelStockArtCover
     * @param CollectionFactory $stockArtCoverCollectionFactory
     * @param StockArtCoverSearchResultsInterfaceFactory $stockArtCoverSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        StockArtCoverFactory $stockArtCoverFactory,
        ResourceModelStockArtCover $resourceModelStockArtCover,
        CollectionFactory $stockArtCoverCollectionFactory,
        StockArtCoverSearchResultsInterfaceFactory $stockArtCoverSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_stockArtCoverFactory                       = $stockArtCoverFactory;
        $this->_resourceModelStockArtCover                 = $resourceModelStockArtCover;
        $this->_stockArtCoverCollectionFactory             = $stockArtCoverCollectionFactory;
        $this->_stockArtCoverSearchResultsInterfaceFactory = $stockArtCoverSearchResultsInterfaceFactory;
        $this->_collectionProcessor                        = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor           = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($id, $name, $thumbnail, $img)
    {
        $stockArtCover = $this->_stockArtCoverFactory->create();
        $stockArtCover->setId($id);
        $stockArtCover->setName($name);
        $stockArtCover->setThumbnail($thumbnail);
        $stockArtCover->setImg($img);
        $this->_resourceModelStockArtCover->save($stockArtCover);
        return $stockArtCover;
    }

    /**
     * @inheritdoc
     */
    public function getById($stockArtCoverId)
    {
        return $this->get($stockArtCoverId);
    }

    /**
     * @inheritdoc
     */
    public function get($value, $attributeCode = null)
    {
        /** @var StockArtCover $stockArtCover */
        $stockArtCover = $this->_stockArtCoverFactory->create()->load($value, $attributeCode);

        if (!$stockArtCover->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity'));
        }

        return $stockArtCover;
    }

    /**
     * @inheritdoc
     */
    public function delete(StockArtCoverInterface $stockArtCover)
    {

        $stockArtCoverId = $stockArtCover->getId();

        try {
            $this->_resourceModelStockArtCover->delete($stockArtCover);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(
                __('Unable to remove entity %1', $stockArtCoverId)
            );
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById($stockArtCoverId)
    {
        $stockArtCover = $this->getById($stockArtCoverId);
        return $this->delete($stockArtCover);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->_stockArtCoverCollectionFactory->create();

        $this->_extensionAttributesJoinProcessor->process($collection, StockArtCoverInterface::class);
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var StockArtCoverSearchResultsInterface $searchResults */
        $searchResults = $this->_stockArtCoverSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}