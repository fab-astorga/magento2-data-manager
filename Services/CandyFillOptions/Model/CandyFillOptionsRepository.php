<?php

namespace Services\CandyFillOptions\Model;

use Exception;
use Services\CandyFillOptions\Api\Data\CandyFillOptionsInterface;
use Services\CandyFillOptions\Api\Data\CandyFillOptionsSearchResultsInterface;
use Services\CandyFillOptions\Api\Data\CandyFillOptionsSearchResultsInterfaceFactory;
use Services\CandyFillOptions\Api\CandyFillOptionsRepositoryInterface;
use Services\CandyFillOptions\Model\CandyFillOptionsFactory;
use Services\CandyFillOptions\Model\ResourceModel\CandyFillOptions as ResourceModelCandyFillOptions;
use Services\CandyFillOptions\Model\ResourceModel\CandyFillOptions\Collection;
use Services\CandyFillOptions\Model\ResourceModel\CandyFillOptions\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class CandyFillOptionsRepository
 */
class CandyFillOptionsRepository implements CandyFillOptionsRepositoryInterface
{

    /**
     * @var CandyFillOptionsFactory
     */
    private $_candyFillOptionsFactory;

    /**
     * @var ResourceModelCandyFillOptions
     */
    private $_resourceModelCandyFillOptions;

    /**
     * @var CollectionFactory
     */
    private $_candyFillOptionsCollectionFactory;

    /**
     * @var CandyFillOptionsSearchResultsInterfaceFactory
     */
    private $_candyFillOptionsSearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    /**
     * CandyFillOptionsRepository constructor.
     *
     * @param CandyFillOptionsFactory $candyFillOptionsFactory
     * @param ResourceModelCandyFillOptions $resourceModelCandyFillOptions
     * @param CollectionFactory $candyFillOptionsCollectionFactory
     * @param CandyFillOptionsSearchResultsInterfaceFactory $candyFillOptionsSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        CandyFillOptionsFactory $candyFillOptionsFactory,
        ResourceModelCandyFillOptions $resourceModelCandyFillOptions,
        CollectionFactory $candyFillOptionsCollectionFactory,
        CandyFillOptionsSearchResultsInterfaceFactory $candyFillOptionsSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_candyFillOptionsFactory                       = $candyFillOptionsFactory;
        $this->_resourceModelCandyFillOptions                 = $resourceModelCandyFillOptions;
        $this->_candyFillOptionsCollectionFactory             = $candyFillOptionsCollectionFactory;
        $this->_candyFillOptionsSearchResultsInterfaceFactory = $candyFillOptionsSearchResultsInterfaceFactory;
        $this->_collectionProcessor                           = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor              = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($id, $sku, $name, $img, $category, $salesDescription, $purchaseDescription)
    {
        $candyFillOptions = $this->_candyFillOptionsFactory->create();
        $candyFillOptions = $candyFillOptions->load($sku, 'sku');
        if (!$candyFillOptions->getId()) {
            $candyFillOptions = $this->_candyFillOptionsFactory->create();
        }
        $candyFillOptions->setId($id);
        $candyFillOptions->setsku($sku);
        $candyFillOptions->setName($name);
        $candyFillOptions->setImg($img);
        $candyFillOptions->setCategory($category);
        $candyFillOptions->setSalesDescription($salesDescription);
        $candyFillOptions->setPurchaseDescription($purchaseDescription);
        $this->_resourceModelCandyFillOptions->save($candyFillOptions);
        return $candyFillOptions;
    }

    /**
     * @inheritdoc
     */
    public function getById($candyFillOptionsId)
    {
        return $this->get($candyFillOptionsId);
    }

    /**
     * @inheritdoc
     */
    public function deleteById($candyFillOptionsId)
    {
        $candyFillOption = $this->getById($candyFillOptionsId);
        return $this->delete($candyFillOption);
    }

    /**
     * @inheritdoc
     */
    public function delete()
    {
        try { 
            $collection = $this->_candyFillOptionsCollectionFactory->create();
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
        $collection = $this->_candyFillOptionsCollectionFactory->create();

        $this->_extensionAttributesJoinProcessor->process($collection, CandyFillOptionsInterface::class);
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var CandyFillOptionsSearchResultsInterface $searchResults */
        $searchResults = $this->_candyFillOptionsSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}