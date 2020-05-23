<?php

namespace Services\GlitterInserts\Model;

use Exception;
use Services\GlitterInserts\Api\Data\GlitterMetallicInsertsPricesInterface;
use Services\GlitterInserts\Api\Data\GlitterMetallicInsertsPricesSearchResultsInterface;
use Services\GlitterInserts\Api\Data\GlitterMetallicInsertsPricesSearchResultsInterfaceFactory;
use Services\GlitterInserts\Api\GlitterMetallicInsertsPricesRepositoryInterface;
use Services\GlitterInserts\Model\GlitterMetallicInsertsPricesFactory;
use Services\GlitterInserts\Model\ResourceModel\GlitterMetallicInsertsPrices as ResourceModelGlitterMetallicInsertsPrices;
use Services\GlitterInserts\Model\ResourceModel\GlitterMetallicInsertsPrices\Collection;
use Services\GlitterInserts\Model\ResourceModel\GlitterMetallicInsertsPrices\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GlitterMetallicInsertsPricesRepository
 */
class GlitterMetallicInsertsPricesRepository implements GlitterMetallicInsertsPricesRepositoryInterface
{

    /**
     * @var GlitterMetallicInsertsPricesFactory
     */
    private $_glitterMetallicInsertsPricesFactory;

    /**
     * @var ResourceModelGlitterMetallicInsertsPrices
     */
    private $_resourceModelGlitterMetallicInsertsPrices;

    /**
     * @var CollectionFactory
     */
    private $_glitterMetallicInsertsPricesCollectionFactory;

    /**
     * @var GlitterMetallicInsertsPricesSearchResultsInterfaceFactory
     */
    private $_glitterMetallicInsertsPricesSearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    /**
     * GlitterMetallicInsertsRepository constructor.
     *
     * @param GlitterMetallicInsertsPricesFactory $glitterMetallicInsertsPricesFactory
     * @param ResourceModelGlitterMetallicInsertsPrices $resourceModelGlitterMetallicInsertsPrices
     * @param CollectionFactory $glitterMetallicInsertsPricesCollectionFactory
     * @param GlitterMetallicInsertsPricesSearchResultsInterfaceFactory $glitterMetallicInsertsPricesSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        GlitterMetallicInsertsPricesFactory $glitterMetallicInsertsPricesFactory,
        ResourceModelGlitterMetallicInsertsPrices $resourceModelGlitterMetallicInsertsPrices,
        CollectionFactory $glitterMetallicInsertsPricesCollectionFactory,
        GlitterMetallicInsertsPricesSearchResultsInterfaceFactory $glitterMetallicInsertsPricesSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_glitterMetallicInsertsPricesFactory                       = $glitterMetallicInsertsPricesFactory;
        $this->_resourceModelGlitterMetallicInsertsPrices                 = $resourceModelGlitterMetallicInsertsPrices;
        $this->_glitterMetallicInsertsPricesCollectionFactory             = $glitterMetallicInsertsPricesCollectionFactory;
        $this->_glitterMetallicInsertsPricesSearchResultsInterfaceFactory = $glitterMetallicInsertsPricesSearchResultsInterfaceFactory;
        $this->_collectionProcessor                                       = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor                          = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($id, $sku, $currency, $priceLevel, $minQuantity, $unitPrice)
    {
        $glitterMetallicInsertsPrices = $this->_glitterMetallicInsertsPricesFactory->create();
        $glitterMetallicInsertsPrices = $glitterMetallicInsertsPrices->load($id, 'id');
        if (!$glitterMetallicInsertsPrices->getId()) {
            $glitterMetallicInsertsPrices = $this->_glitterMetallicInsertsPricesFactory->create();
        }
        $glitterMetallicInsertsPrices->setId($id);
        $glitterMetallicInsertsPrices->setsku($sku);
        $glitterMetallicInsertsPrices->setCurrency($currency);
        $glitterMetallicInsertsPrices->setPriceLevel($priceLevel);
        $glitterMetallicInsertsPrices->setMinQuantity($minQuantity);
        $glitterMetallicInsertsPrices->setUnitPrice($unitPrice);
        $this->_resourceModelGlitterMetallicInsertsPrices->save($glitterMetallicInsertsPrices);
        return $glitterMetallicInsertsPrices;
    }

    /**
     * @inheritdoc
     */
    public function getById($glitterMetallicInsertsPricesId)
    {
        return $this->get($glitterMetallicInsertsPricesId);
    }

    /**
     * @inheritdoc
     */
    public function deleteById($glitterMetallicInsertsPricesId)
    {
        $glitterMetallicInsertPrice = $this->getById($glitterMetallicInsertsPricesId);
        return $this->delete($glitterMetallicInsertPrice);
    }

    /**
     * @inheritdoc
     */
    public function delete()
    {
        try { 
            $collection = $this->_glitterMetallicInsertsPricesCollectionFactory->create();
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
        $collection = $this->_glitterMetallicInsertsPricesCollectionFactory->create();

        $this->_extensionAttributesJoinProcessor->process($collection, GlitterMetallicInsertsPricesInterface::class);
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var GlitterMetallicInsertsPricesSearchResultsInterface $searchResults */
        $searchResults = $this->_glitterMetallicInsertsPricesSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}