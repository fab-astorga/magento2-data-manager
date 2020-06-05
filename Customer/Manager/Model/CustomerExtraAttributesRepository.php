<?php

namespace Customer\Manager\Model;

use Exception;
use Customer\Manager\Api\Data\CustomerExtraAttributesInterface;
use Customer\Manager\Api\Data\CustomerExtraAttributesSearchResultsInterface;
use Customer\Manager\Api\Data\CustomerExtraAttributesSearchResultsInterfaceFactory;
use Customer\Manager\Api\CustomerExtraAttributesRepositoryInterface;
use Customer\Manager\Model\CustomerExtraAttributesFactory;
use Customer\Manager\Model\ResourceModel\CustomerExtraAttributes as ResourceModelCustomerExtraAttributes;
use Customer\Manager\Model\ResourceModel\CustomerExtraAttributes\Collection;
use Customer\Manager\Model\ResourceModel\CustomerExtraAttributes\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class CustomerExtraAttributesRepository
 */
class CustomerExtraAttributesRepository implements CustomerExtraAttributesRepositoryInterface
{

    /**
     * @var CustomerExtraAttributesFactory
     */
    private $_customerExtraAttributesFactory;

    /**
     * @var ResourceModelCustomerExtraAttributes
     */
    private $_resourceModelCustomerExtraAttributes;

    /**
     * @var CollectionFactory
     */
    private $_customerExtraAttributesCollectionFactory;

    /**
     * @var CustomerExtraAttributesSearchResultsInterfaceFactory
     */
    private $_customerExtraAttributesSearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    /**
     * CustomerExtraAttributesRepository constructor.
     *
     * @param CustomerExtraAttributesFactory $customerExtraAttributesFactory
     * @param ResourceModelCustomerExtraAttributes $resourceModelCustomerExtraAttributes
     * @param CollectionFactory $customerExtraAttributesCollectionFactory
     * @param CustomerExtraAttributesSearchResultsInterfaceFactory $customerExtraAttributesSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        CustomerExtraAttributesFactory $customerExtraAttributesFactory,
        ResourceModelCustomerExtraAttributes $resourceModelCustomerExtraAttributes,
        CollectionFactory $customerExtraAttributesCollectionFactory,
        CustomerExtraAttributesSearchResultsInterfaceFactory $customerExtraAttributesSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_customerExtraAttributesFactory                       = $customerExtraAttributesFactory;
        $this->_resourceModelCustomerExtraAttributes                 = $resourceModelCustomerExtraAttributes;
        $this->_customerExtraAttributesCollectionFactory             = $customerExtraAttributesCollectionFactory;
        $this->_customerExtraAttributesSearchResultsInterfaceFactory = $customerExtraAttributesSearchResultsInterfaceFactory;
        $this->_collectionProcessor                                  = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor                     = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($customerId, $netsuiteId, $role, $jobTitle, $permission)
    {
        $customerExtraAttributes = $this->_customerExtraAttributesFactory->create();
        $customerExtraAttributes->setCustomerId($customerId);
        $customerExtraAttributes->setNetsuiteId($netsuiteId);
        $customerExtraAttributes->setRole($role);
        $customerExtraAttributes->setJobTitle($jobTitle);
        $customerExtraAttributes->setPermission($permission);
        $this->_resourceModelCustomerExtraAttributes->save($customerExtraAttributes);
        return $customerExtraAttributes;
    }

    /**
     * @inheritdoc
     */
    public function getById($customerExtraAttributesId)
    {
        return $this->get($customerExtraAttributesId);
    }

    /**
     * @inheritdoc
     */
    public function get($value, $attributeCode)
    {
        /** @var CustomerExtraAttributes $customerExtraAttributes */
        $customerExtraAttributes = $this->_customerExtraAttributesFactory->create()->load($value, $attributeCode);

        if (!$customerExtraAttributes->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity'));
        }
        
        return $customerExtraAttributes;
    }

    /**
     * @inheritdoc
     */
    public function delete(CustomerExtraAttributesInterface $customerExtraAttributes)
    {

        $customerExtraAttributesId = $customerExtraAttributes->getId();

        try {
            $this->_resourceModelCustomerExtraAttributes->delete($customerExtraAttributes);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(
                __('Unable to remove entity %1', $customerExtraAttributesId)
            );
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById($customerExtraAttributesId)
    {
        $customerExtraAttributes = $this->getById($customerExtraAttributesId);
        return $this->delete($customerExtraAttributes);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->_customerExtraAttributesCollectionFactory->create();
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var CustomerExtraAttributesSearchResultsInterface $searchResults */
        $searchResults = $this->_customerExtraAttributesSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}