<?php

namespace DistributorTools\FlyersEblasts\Model;

use Exception;
use DistributorTools\FlyersEblasts\Api\Data\FlyersEblastsInterface;
use DistributorTools\FlyersEblasts\Api\Data\FlyersEblastsSearchResultsInterface;
use DistributorTools\FlyersEblasts\Api\Data\FlyersEblastsSearchResultsInterfaceFactory;
use DistributorTools\FlyersEblasts\Api\FlyersEblastsRepositoryInterface;
use DistributorTools\FlyersEblasts\Model\FlyersEblastsFactory;
use DistributorTools\FlyersEblasts\Model\ResourceModel\FlyersEblasts as ResourceModelFlyersEblasts;
use DistributorTools\FlyersEblasts\Model\ResourceModel\FlyersEblasts\Collection;
use DistributorTools\FlyersEblasts\Model\ResourceModel\FlyersEblasts\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class FlyersEblastsRepository
 */
class FlyersEblastsRepository implements FlyersEblastsRepositoryInterface
{

    /**
     * @var FlyersEblastsFactory
     */
    private $_flyersEblastsFactory;

    /**
     * @var ResourceModelFlyersEblasts
     */
    private $_resourceModelFlyersEblasts;

    /**
     * @var CollectionFactory
     */
    private $_flyersEblastsCollectionFactory;

    /**
     * @var FlyersEblastsSearchResultsInterfaceFactory
     */
    private $_flyersEblastsSearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    /**
     * FlyersEblastsRepository constructor.
     *
     * @param FlyersEblastsFactory $flyersEblastsFactory
     * @param ResourceModelFlyersEblasts $resourceModelFlyersEblasts
     * @param CollectionFactory $flyersEblastsCollectionFactory
     * @param FlyersEblastsSearchResultsInterfaceFactory $flyersEblastsSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        FlyersEblastsFactory $flyersEblastsFactory,
        ResourceModelFlyersEblasts $resourceModelFlyersEblasts,
        CollectionFactory $flyersEblastsCollectionFactory,
        FlyersEblastsSearchResultsInterfaceFactory $flyersEblastsSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_flyersEblastsFactory                       = $flyersEblastsFactory;
        $this->_resourceModelFlyersEblasts                 = $resourceModelFlyersEblasts;
        $this->_flyersEblastsCollectionFactory             = $flyersEblastsCollectionFactory;
        $this->_flyersEblastsSearchResultsInterfaceFactory = $flyersEblastsSearchResultsInterfaceFactory;
        $this->_collectionProcessor                        = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor           = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($id, $name, $img)
    {
        $flyersEblast = $this->_flyersEblastsFactory->create();
        if (!$flyersEblast->getId()) {
            $flyersEblast = $this->_flyersEblastsFactory->create();
        }
        $flyersEblast->setId($id);
        $flyersEblast->setName($name);
        $flyersEblast->setImg($img);
        $this->_resourceModelFlyersEblasts->save($flyersEblast);
        return $flyersEblast;
    }

    /**
     * @inheritdoc
     */
    public function getById($flyersEblastsId)
    {
        return $this->get($flyersEblastsId);
    }

    /**
     * @inheritdoc
     */
    public function deleteById($flyersEblastsId)
    {
        $flyersEblast = $this->getById($flyersEblastsId);
        return $this->delete($flyersEblast);
    }

    /**
     * @inheritdoc
     */
    public function delete()
    {
        try { 
            $collection = $this->_flyersEblastsCollectionFactory->create();
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
        $collection = $this->_flyersEblastsCollectionFactory->create();

        $this->_extensionAttributesJoinProcessor->process($collection, FlyersEblastsInterface::class);
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var FlyersEblastsSearchResultsInterface $searchResults */
        $searchResults = $this->_flyersEblastsSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}