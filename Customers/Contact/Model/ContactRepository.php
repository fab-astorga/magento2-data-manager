<?php

namespace Customers\Contact\Model;

use Exception;
use \Customers\Contact\Api\Data\ContactInterface;
use \Customers\Contact\Api\Data\ContactSearchResultsInterface;
use \Customers\Contact\Api\Data\ContactSearchResultsInterfaceFactory;
use \Customers\Contact\Api\ContactRepositoryInterface;
use \Customers\Contact\Model\ContactFactory;
use \Customers\Contact\Model\ResourceModel\Contact as ResourceModelContact;
use \Customers\Contact\Model\ResourceModel\Contact\Collection;
use \Customers\Contact\Model\ResourceModel\Contact\CollectionFactory;
use \Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use \Magento\Framework\Api\SearchCriteriaInterface;
use \Magento\Framework\Exception\CouldNotDeleteException;
use \Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class ContactRepository
 */
class ContactRepository implements ContactRepositoryInterface
{

    /**
     * @var ContactFactory
     */
    private $_contactFactory;

    /**
     * @var ResourceModelContact
     */
    private $_resourceModelContact;

    /**
     * @var CollectionFactory
     */
    private $_contactCollectionFactory;

    /**
     * @var ContactSearchResultsInterfaceFactory
     */
    private $_contactSearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    /**
     * ContactRepository constructor.
     *
     * @param ContactFactory $contactFactory
     * @param ResourceModelContact $resourceModelContact
     * @param CollectionFactory $contactCollectionFactory
     * @param ContactSearchResultsInterfaceFactory $contactSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        ContactFactory $contactFactory,
        ResourceModelContact $resourceModelContact,
        CollectionFactory $contactCollectionFactory,
        ContactSearchResultsInterfaceFactory $contactSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_contactFactory                       = $contactFactory;
        $this->_resourceModelContact                 = $resourceModelContact;
        $this->_contactCollectionFactory             = $contactCollectionFactory;
        $this->_contactSearchResultsInterfaceFactory = $contactSearchResultsInterfaceFactory;
        $this->_collectionProcessor                  = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor     = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($netsuiteId, $customerId, $companyId, $jobTitle)
    {
        $contact = $this->_contactFactory->create();
        $contact->setNetsuiteId($netsuiteId);
        $contact->setCustomerId($customerId);
        $contact->setCompanyId($companyId);
        $contact->setJobTitle($jobTitle);
        $this->_resourceModelContact->save($contact);
        return $contact;
    }

    /**
     * @inheritdoc
     */
    public function getById($contactId)
    {
        return $this->get($contactId);
    }

    /**
     * @inheritdoc
     */
    public function get($value, $attributeCode)
    {
        /** @var Contact $contact */
        $contact = $this->_contactFactory->create()->load($value, $attributeCode);

        if (!$contact->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity'));
        }
        
        return $contact;
    }

    /**
     * @inheritdoc
     */
    public function delete(ContactInterface $contact)
    {
        $contactId = $contact->getId();

        try {
            $this->_resourceModelContact->delete($contact);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(
                __('Unable to remove entity %1', $contactId)
            );
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById($contactId)
    {
        $contact = $this->getById($contactId);
        return $this->delete($contact);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->_contactCollectionFactory->create();
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var ContactSearchResultsInterface $searchResults */
        $searchResults = $this->_contactSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}