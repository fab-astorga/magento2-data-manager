<?php

namespace DistributorTools\StockArtLibrary\Model;

use Exception;
use DistributorTools\StockArtLibrary\Api\Data\StockArtImagesAttributeInterface;
use DistributorTools\StockArtLibrary\Api\Data\StockArtImagesAttributeSearchResultsInterface;
use DistributorTools\StockArtLibrary\Api\Data\StockArtImagesAttributeSearchResultsInterfaceFactory;
use DistributorTools\StockArtLibrary\Api\StockArtImagesAttributeRepositoryInterface;
use DistributorTools\StockArtLibrary\Model\StockArtImagesAttributeFactory;
use DistributorTools\StockArtLibrary\Model\ResourceModel\StockArtImagesAttribute as ResourceModelStockArtImagesAttribute;
use DistributorTools\StockArtLibrary\Model\ResourceModel\StockArtImagesAttribute\Collection;
use DistributorTools\StockArtLibrary\Model\ResourceModel\StockArtImagesAttribute\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class StockArtImagesAttributeRepository
 */
class StockArtImagesAttributeRepository implements StockArtImagesAttributeRepositoryInterface
{

    /**
     * @var StockArtImagesAttributeFactory
     */
    private $_stockArtImagesAttributeFactory;

    /**
     * @var ResourceModelStockArtImagesAttribute
     */
    private $_resourceModelStockArtImagesAttribute;

    /**
     * @var CollectionFactory
     */
    private $_stockArtImagesAttributeCollectionFactory;

    /**
     * @var StockArtImagesAttributeSearchResultsInterfaceFactory
     */
    private $_stockArtImagesAttributeSearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    /**
     * StockArtImagesAttributeRepository constructor.
     *
     * @param StockArtImagesAttributeFactory $stockArtImagesAttributeFactory
     * @param ResourceModelStockArtImagesAttribute $resourceModelStockArtImagesAttribute
     * @param CollectionFactory $stockArtImagesAttributeCollectionFactory
     * @param StockArtImagesAttributeSearchResultsInterfaceFactory $stockArtImagesAttributeSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        StockArtImagesAttributeFactory $stockArtImagesAttributeFactory,
        ResourceModelStockArtImagesAttribute $resourceModelStockArtImagesAttribute,
        CollectionFactory $stockArtImagesAttributeCollectionFactory,
        StockArtImagesAttributeSearchResultsInterfaceFactory $stockArtImagesAttributeSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_stockArtImagesAttributeFactory                       = $stockArtImagesAttributeFactory;
        $this->_resourceModelStockArtImagesAttribute                 = $resourceModelStockArtImagesAttribute;
        $this->_stockArtImagesAttributeCollectionFactory             = $stockArtImagesAttributeCollectionFactory;
        $this->_stockArtImagesAttributeSearchResultsInterfaceFactory = $stockArtImagesAttributeSearchResultsInterfaceFactory;
        $this->_collectionProcessor                                  = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor                     = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($id, $coverId, $name, $img)
    {
        $stockArtImagesAttribute = $this->_stockArtImagesAttributeFactory->create();
        $stockArtImagesAttribute->setId($id);
        $stockArtImagesAttribute->setCoverId($coverId);
        $stockArtImagesAttribute->setName($name);
        $stockArtImagesAttribute->setImg($img);
        $this->_resourceModelStockArtImagesAttribute->save($stockArtImagesAttribute);
        return $stockArtImagesAttribute;
    }

    /**
     * @inheritdoc
     */
    public function getById($stockArtImagesAttributeId)
    {
        return $this->get($stockArtImagesAttributeId);
    }

    /**
     * @inheritdoc
     */
    public function get($value, $attributeCode = null)
    {
        /** @var StockArtImagesAttribute $stockArtImagesAttribute */
        $stockArtImagesAttribute = $this->_stockArtImagesAttributeFactory->create()->load($value, $attributeCode);

        if (!$stockArtImagesAttribute->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity'));
        }

        return $stockArtImagesAttribute;
    }

    /**
     * @inheritdoc
     */
    public function delete(StockArtImagesAttributeInterface $stockArtImagesAttribute)
    {

        $stockArtImagesAttributeId = $stockArtImagesAttribute->getId();

        try {
            $this->_resourceModelStockArtImagesAttribute->delete($stockArtImagesAttribute);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(
                __('Unable to remove entity %1', $stockArtImagesAttributeId)
            );
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById($stockArtImagesAttributeId)
    {
        $stockArtImagesAttribute = $this->getById($stockArtImagesAttributeId);
        return $this->delete($stockArtImagesAttribute);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->_stockArtImagesAttributeCollectionFactory->create();
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var StockArtImagesAttributeSearchResultsInterface $searchResults */
        $searchResults = $this->_stockArtImagesAttributeSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}