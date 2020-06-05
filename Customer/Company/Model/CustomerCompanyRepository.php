<?php

namespace Customer\Company\Model;

use Exception;
use Customer\Company\Api\Data\CustomerCompanyInterface;
use Customer\Company\Api\Data\CustomerCompanySearchResultsInterface;
use Customer\Company\Api\Data\CustomerCompanySearchResultsInterfaceFactory;
use Customer\Company\Api\CustomerCompanyRepositoryInterface;
use Customer\Company\Model\CustomerCompanyFactory;
use Customer\Company\Model\ResourceModel\CustomerCompany as ResourceModelCustomerCompany;
use Customer\Company\Model\ResourceModel\CustomerCompany\Collection;
use Customer\Company\Model\ResourceModel\CustomerCompany\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class CustomerCompanyRepository
 */
class CustomerCompanyRepository implements CustomerCompanyRepositoryInterface
{

    /**
     * @var CustomerCompanyFactory
     */
    private $_customerCompanyFactory;

    /**
     * @var ResourceModelCustomerCompany
     */
    private $_resourceModelCustomerCompany;

    /**
     * @var CollectionFactory
     */
    private $_customerCompanyCollectionFactory;

    /**
     * @var CustomerCompanySearchResultsInterfaceFactory
     */
    private $_customerCompanySearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    protected $_logger;
    /**
     * CustomerCompanyRepository constructor.
     *
     * @param CustomerCompanyFactory $customerCompanyFactory
     * @param ResourceModelCustomerCompany $resourceModelCustomerCompany
     * @param CollectionFactory $customerCompanyCollectionFactory
     * @param CustomerCompanySearchResultsInterfaceFactory $customerCompanySearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        CustomerCompanyFactory $customerCompanyFactory,
        ResourceModelCustomerCompany $resourceModelCustomerCompany,
        CollectionFactory $customerCompanyCollectionFactory,
        CustomerCompanySearchResultsInterfaceFactory $customerCompanySearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        \File\CustomLog\Logger\Logger $logger
    ) {
        $this->_customerCompanyFactory                       = $customerCompanyFactory;
        $this->_resourceModelCustomerCompany                 = $resourceModelCustomerCompany;
        $this->_customerCompanyCollectionFactory             = $customerCompanyCollectionFactory;
        $this->_customerCompanySearchResultsInterfaceFactory = $customerCompanySearchResultsInterfaceFactory;
        $this->_collectionProcessor                          = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor             = $extensionAttributesJoinProcessor;
        $this->_logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function save($netsuiteId, $companyName, $priceLevel, $invoiceEmail, 
                              $phone, $altPhone, $fax, $additionalInvoiceEmailRecipient)
    {
        $customerCompany = $this->_customerCompanyFactory->create();
        $customerCompany->setNetsuiteId($netsuiteId);
        $customerCompany->setCompanyName($companyName);
        $customerCompany->setPriceLevel($priceLevel);
        $customerCompany->setInvoiceEmail($invoiceEmail);
        $customerCompany->setPhone($phone);
        $customerCompany->setAltPhone($altPhone);
        $customerCompany->setFax($fax);
        $customerCompany->setAdditionalInvoiceEmailRecipient($additionalInvoiceEmailRecipient);
        $this->_resourceModelCustomerCompany->save($customerCompany);
        return $customerCompany;
    }

    /**
     * @inheritdoc
     */
    public function getById($netsuiteId)
    {
        $company = $this->get($netsuiteId);
        return $company;
    }

    /**
     * @inheritdoc
     */
    public function get($value, $attributeCode = null)
    {
        /** @var CustomerCompany $CustomerCompany */
        $customerCompany = $this->_customerCompanyFactory->create()->load($value, $attributeCode);

        if (!$customerCompany->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity'));
        }
        
        return $customerCompany;
    }

    /**
     * @inheritdoc
     */
    public function delete(CustomerCompanyInterface $customerCompany)
    {
        $customerCompanyId = $customerCompany->getId();

        try {
            $this->_resourceModelCustomerCompany->delete($customerCompany);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(
                __('Unable to remove entity %1', $customerCompanyId)
            );
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById($netsuiteId)
    {
        $customerCompany = $this->getById($netsuiteId);
        return $this->delete($customerCompany);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->_customerCompanyCollectionFactory->create();
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var CustomerCompanySearchResultsInterface $searchResults */
        $searchResults = $this->_customerCompanySearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}