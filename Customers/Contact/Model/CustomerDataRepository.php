<?php

namespace Customers\Contact\Model;

use Exception;
use \Customers\Contact\Api\Data\CustomerDataInterface;
use \Customers\Contact\Api\Data\CustomerDataSearchResultsInterface;
use \Customers\Contact\Api\Data\CustomerDataSearchResultsInterfaceFactory;
use \Customers\Contact\Api\CustomerDataRepositoryInterface;
use \Customers\Contact\Model\CustomerDataFactory;
use \Customers\Contact\Model\ResourceModel\CustomerData as ResourceModelCustomerData;
use \Customers\Contact\Model\ResourceModel\CustomerData\Collection;
use \Customers\Contact\Model\ResourceModel\CustomerData\CollectionFactory;
use \Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use \Magento\Framework\Api\SearchCriteriaInterface;
use \Magento\Framework\Exception\CouldNotDeleteException;
use \Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class CustomerDataRepository
 */
class CustomerDataRepository implements CustomerDataRepositoryInterface
{

    /**
     * @var CustomerDataFactory
     */
    private $_customerDataFactory;

    /**
     * @var ResourceModelCustomerData
     */
    private $_resourceModelCustomerData;

    /**
     * @var CollectionFactory
     */
    private $_customerDataCollectionFactory;

    /**
     * @var CustomerDataSearchResultsInterfaceFactory
     */
    private $_customerDataSearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    /**
     * CustomerDataRepository constructor.
     *
     * @param CustomerDataFactory $customerDataFactory
     * @param ResourceModelCustomerData $resourceModelCustomerData
     * @param CollectionFactory $customerDataCollectionFactory
     * @param CustomerDataSearchResultsInterfaceFactory $customerDataSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        CustomerDataFactory $customerDataFactory,
        ResourceModelCustomerData $resourceModelCustomerData,
        CollectionFactory $customerDataCollectionFactory,
        CustomerDataSearchResultsInterfaceFactory $customerDataSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_customerDataFactory                       = $customerDataFactory;
        $this->_resourceModelCustomerData                 = $resourceModelCustomerData;
        $this->_customerDataCollectionFactory             = $customerDataCollectionFactory;
        $this->_customerDataSearchResultsInterfaceFactory = $customerDataSearchResultsInterfaceFactory;
        $this->_collectionProcessor                       = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor          = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($customerId, $customerType)
    {
        $customerData = $this->_customerDataFactory->create();
        $customerData->setCustomerId($customerId);
        $customerData->setCustomerType($customerType);
        $this->_resourceModelCustomerData->save($customerData);
        return $customerData;
    }

    /**
     * @inheritdoc
     */
    public function getById($id)
    {
        return $this->get($id);
    }

    /**
     * @inheritdoc
     */
    public function get($value, $attributeCode)
    {
        /** @var CustomerData $customerData */
        $customerData = $this->_customerDataFactory->create()->load($value, $attributeCode);

        if (!$customerData->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity'));
        }
        
        return $customerData;
    }

    /**
     * @inheritdoc
     */
    public function delete(CustomerDataInterface $customerData)
    {
        $customerDataId = $customerData->getId();

        try {
            $this->_resourceModelCustomerData->delete($customerData);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(
                __('Unable to remove entity %1', $customerDataId)
            );
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById($id)
    {
        $customerData = $this->getById($id);
        return $this->delete($customerData);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->_customerDataCollectionFactory->create();
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var CustomerDataSearchResultsInterface $searchResults */
        $searchResults = $this->_customerDataSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}