<?php

namespace Services\CandyFillOptions\Model;

use Exception;
use Services\CandyFillOptions\Api\Data\CandyFillOptionsPricesInterface;
use Services\CandyFillOptions\Api\Data\CandyFillOptionsPricesSearchResultsInterface;
use Services\CandyFillOptions\Api\Data\CandyFillOptionsPricesSearchResultsInterfaceFactory;
use Services\CandyFillOptions\Api\CandyFillOptionsPricesRepositoryInterface;
use Services\CandyFillOptions\Model\CandyFillOptionsPricesFactory;
use Services\CandyFillOptions\Model\ResourceModel\CandyFillOptionsPrices as ResourceModelCandyFillOptionsPrices;
use Services\CandyFillOptions\Model\ResourceModel\CandyFillOptionsPrices\Collection;
use Services\CandyFillOptions\Model\ResourceModel\CandyFillOptionsPrices\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class CandyFillOptionsPricesRepository
 */
class CandyFillOptionsPricesRepository implements CandyFillOptionsPricesRepositoryInterface
{

    /**
     * @var CandyFillOptionsPricesFactory
     */
    private $_candyFillOptionsPricesFactory;

    /**
     * @var ResourceModelCandyFillOptionsPrices
     */
    private $_resourceModelCandyFillOptionsPrices;

    /**
     * @var CollectionFactory
     */
    private $_candyFillOptionsPricesCollectionFactory;

    /**
     * @var CandyFillOptionsPricesSearchResultsInterfaceFactory
     */
    private $_candyFillOptionsPricesSearchResultsInterfaceFactory;

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
     * @param CandyFillOptionsPricesFactory $candyFillOptionsPricesFactory
     * @param ResourceModelCandyFillOptionsPrices $resourceModelCandyFillOptionsPrices
     * @param CollectionFactory $candyFillOptionsPricesCollectionFactory
     * @param CandyFillOptionsPricesSearchResultsInterfaceFactory $candyFillOptionsPricesSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        CandyFillOptionsPricesFactory $candyFillOptionsPricesFactory,
        ResourceModelCandyFillOptionsPrices $resourceModelCandyFillOptionsPrices,
        CollectionFactory $candyFillOptionsPricesCollectionFactory,
        CandyFillOptionsPricesSearchResultsInterfaceFactory $candyFillOptionsPricesSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_candyFillOptionsPricesFactory                       = $candyFillOptionsPricesFactory;
        $this->_resourceModelCandyFillOptionsPrices                 = $resourceModelCandyFillOptionsPrices;
        $this->_candyFillOptionsPricesCollectionFactory             = $candyFillOptionsPricesCollectionFactory;
        $this->_candyFillOptionsPricesSearchResultsInterfaceFactory = $candyFillOptionsPricesSearchResultsInterfaceFactory;
        $this->_collectionProcessor                                 = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor                    = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($id, $sku, $currency, $priceLevel, $minQuantity, $unitPrice)
    {
        $candyFillOptionsPrices = $this->_candyFillOptionsPricesFactory->create();
        $candyFillOptionsPrices = $candyFillOptionsPrices->load($id, 'id');
        if (!$candyFillOptionsPrices->getId()) {
            $candyFillOptionsPrices = $this->_candyFillOptionsPricesFactory->create();
        }
        $candyFillOptionsPrices->setId($id);
        $candyFillOptionsPrices->setsku($sku);
        $candyFillOptionsPrices->setCurrency($currency);
        $candyFillOptionsPrices->setPriceLevel($priceLevel);
        $candyFillOptionsPrices->setMinQuantity($minQuantity);
        $candyFillOptionsPrices->setUnitPrice($unitPrice);
        $this->_resourceModelCandyFillOptionsPrices->save($candyFillOptionsPrices);
        return $candyFillOptionsPrices;
    }

    /**
     * @inheritdoc
     */
    public function getById($candyFillOptionsPricesId)
    {
        return $this->get($candyFillOptionsPricesId);
    }

    /**
     * @inheritdoc
     */
    public function deleteById($candyFillOptionsPricesId)
    {
        $candyFillOptionsPrice = $this->getById($candyFillOptionsPricesId);
        return $this->delete($candyFillOptionsPrice);
    }

    /**
     * @inheritdoc
     */
    public function delete()
    {
        try { 
            $collection = $this->_candyFillOptionsPricesCollectionFactory->create();
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
        $collection = $this->_candyFillOptionsPricesCollectionFactory->create();

        $this->_extensionAttributesJoinProcessor->process($collection, CandyFillOptionsPricesInterface::class);
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var CandyFillOptionsPricesSearchResultsInterface $searchResults */
        $searchResults = $this->_candyFillOptionsPricesSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}