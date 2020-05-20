<?php

namespace ConfettiInserts\Manager\Model;

use Exception;
use ConfettiInserts\Manager\Api\Data\ConfettiInsertsPricesInterface;
use ConfettiInserts\Manager\Api\Data\ConfettiInsertsPricesSearchResultsInterface;
use ConfettiInserts\Manager\Api\Data\ConfettiInsertsPricesSearchResultsInterfaceFactory;
use ConfettiInserts\Manager\Api\ConfettiInsertsPricesRepositoryInterface;
use ConfettiInserts\Manager\Model\ConfettiInsertsPricesFactory;
use ConfettiInserts\Manager\Model\ResourceModel\ConfettiInsertsPrices as ResourceModelConfettiInsertsPrices;
use ConfettiInserts\Manager\Model\ResourceModel\ConfettiInsertsPrices\Collection;
use ConfettiInserts\Manager\Model\ResourceModel\ConfettiInsertsPrices\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class ConfettiInsertsPricesRepository
 */
class ConfettiInsertsPricesRepository implements ConfettiInsertsPricesRepositoryInterface
{

    /**
     * @var ConfettiInsertsPricesFactory
     */
    private $_confettiInsertsPricesFactory;

    /**
     * @var ResourceModelConfettiInsertsPrices
     */
    private $_resourceModelConfettiInsertsPrices;

    /**
     * @var CollectionFactory
     */
    private $_confettiInsertsPricesCollectionFactory;

    /**
     * @var ConfettiInsertsPricesSearchResultsInterfaceFactory
     */
    private $_confettiInsertsPricesSearchResultsInterfaceFactory;

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
     * @param ConfettiInsertsPricesFactory $confettiInsertsPricesFactory
     * @param ResourceModelConfettiInsertsPrices $resourceModelConfettiInsertsPrices
     * @param CollectionFactory $confettiInsertsPricesCollectionFactory
     * @param ConfettiInsertsPricesSearchResultsInterfaceFactory $confettiInsertsPricesSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        ConfettiInsertsPricesFactory $confettiInsertsPricesFactory,
        ResourceModelConfettiInsertsPrices $resourceModelConfettiInsertsPrices,
        CollectionFactory $confettiInsertsPricesCollectionFactory,
        ConfettiInsertsPricesSearchResultsInterfaceFactory $confettiInsertsPricesSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_confettiInsertsPricesFactory                       = $confettiInsertsPricesFactory;
        $this->_resourceModelConfettiInsertsPrices                 = $resourceModelConfettiInsertsPrices;
        $this->_confettiInsertsPricesCollectionFactory             = $confettiInsertsPricesCollectionFactory;
        $this->_confettiInsertsPricesSearchResultsInterfaceFactory = $confettiInsertsPricesSearchResultsInterfaceFactory;
        $this->_collectionProcessor                                = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor                   = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($id, $sku, $currency, $priceLevel, $minQuantity, $unitPrice)
    {
        $confettiInsertsPrices = $this->_confettiInsertsPricesFactory->create();
        $confettiInsertsPrices = $confettiInsertsPrices->load($id, 'id');
        if (!$confettiInsertsPrices->getId()) {
            $confettiInsertsPrices = $this->_confettiInsertsPricesFactory->create();
        }
        $confettiInsertsPrices->setId($id);
        $confettiInsertsPrices->setsku($sku);
        $confettiInsertsPrices->setCurrency($currency);
        $confettiInsertsPrices->setPriceLevel($priceLevel);
        $confettiInsertsPrices->setMinQuantity($minQuantity);
        $confettiInsertsPrices->setUnitPrice($unitPrice);
        $this->_resourceModelConfettiInsertsPrices->save($confettiInsertsPrices);
        return $confettiInsertsPrices;
    }

    /**
     * @inheritdoc
     */
    public function getById($confettiInsertsPricesId)
    {
        return $this->get($confettiInsertsPricesId);
    }

    /**
     * @inheritdoc
     */
    public function deleteById($confettiInsertsPricesId)
    {
        $confettiInsertPrice = $this->getById($confettiInsertsPricesId);
        return $this->delete($confettiInsertPrice);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->_confettiInsertsPricesCollectionFactory->create();

        $this->_extensionAttributesJoinProcessor->process($collection, ConfettiInsertsPricesInterface::class);
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var ConfettiInsertsPricesSearchResultsInterface $searchResults */
        $searchResults = $this->_confettiInsertsPricesSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}