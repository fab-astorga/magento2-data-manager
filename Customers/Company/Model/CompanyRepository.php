<?php

namespace Customers\Company\Model;

use Exception;
use Customers\Company\Api\Data\CompanyInterface;
use Customers\Company\Api\Data\CompanySearchResultsInterface;
use Customers\Company\Api\Data\CompanySearchResultsInterfaceFactory;
use Customers\Company\Api\CompanyRepositoryInterface;
use Customers\Company\Model\CompanyFactory;
use Customers\Company\Model\ResourceModel\Company as ResourceModelCompany;
use Customers\Company\Model\ResourceModel\Company\Collection;
use Customers\Company\Model\ResourceModel\Company\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class CompanyRepository
 */
class CompanyRepository implements CompanyRepositoryInterface
{

    /**
     * @var CompanyFactory
     */
    private $_companyFactory;

    /**
     * @var ResourceModelCompany
     */
    private $_resourceModelCompany;

    /**
     * @var CollectionFactory
     */
    private $_companyCollectionFactory;

    /**
     * @var CompanySearchResultsInterfaceFactory
     */
    private $_companySearchResultsInterfaceFactory;

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
     * @param CompanyFactory $companyFactory
     * @param ResourceModelCompany $resourceModelCompany
     * @param CollectionFactory $companyCollectionFactory
     * @param CompanySearchResultsInterfaceFactory $companySearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        CompanyFactory $companyFactory,
        ResourceModelCompany $resourceModelCompany,
        CollectionFactory $companyCollectionFactory,
        CompanySearchResultsInterfaceFactory $companySearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        \File\CustomLog\Logger\Logger $logger
    ) {
        $this->_companyFactory                       = $companyFactory;
        $this->_resourceModelCompany                 = $resourceModelCompany;
        $this->_companyCollectionFactory             = $companyCollectionFactory;
        $this->_companySearchResultsInterfaceFactory = $companySearchResultsInterfaceFactory;
        $this->_collectionProcessor                  = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor     = $extensionAttributesJoinProcessor;
        $this->_logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function save(
        $customerId,
        $netsuiteId, 
        $companyName,  
        $invoiceEmail, 
        $businessPhone,            
        $stateSalesTaxLicense, 
        $websiteAddress, 
        $preferredModeOfDelivery,                             
        $altPhone, 
        $fax, 
        $priceLevel,                          
        $additionalInvoiceEmailRecipient, 
        $access
    )
    {
        $company = $this->_companyFactory->create();
        $company->setCustomerId($customerId);
        $company->setNetsuiteId($netsuiteId);
        $company->setCompanyName($companyName);
        $company->setInvoiceEmail($invoiceEmail);
        $company->setBusinessPhone($businessPhone);
        $company->setStateSalesTaxLicense($stateSalesTaxLicense);
        $company->setWebsiteAddress($websiteAddress);
        $company->setPreferredModeOfDelivery($preferredModeOfDelivery);
        $company->setAltPhone($altPhone);
        $company->setFax($fax);
        $company->setPriceLevel($priceLevel);
        $company->setAdditionalInvoiceEmailRecipient($additionalInvoiceEmailRecipient);
        $company->setAccess($access);
        $this->_resourceModelCompany->save($company);
        return $company;
    }

    /**
     * @inheritdoc
     */
    public function getById($netsuiteId)
    {
        $company = $this->get($netsuiteId, null);
        return $company;
    }

    /**
     * @inheritdoc
     */
    public function get($value, $attributeCode)
    {
        /** @var CustomerCompany $CustomerCompany */
        $company = $this->_companyFactory->create()->load($value, $attributeCode);

        if (!$company->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity'));
        }
        
        return $company;
    }

    /**
     * @inheritdoc
     */
    public function delete(CompanyInterface $company)
    {
        $companyId = $company->getId();

        try {
            $this->_resourceModelCompany->delete($company);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(
                __('Unable to remove entity %1', $companyId)
            );
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById($netsuiteId)
    {
        $companyId = $this->getById($netsuiteId);
        return $this->delete($companyId);
    }


    /**
    * @inheritdoc
    */
    public function getCollection()
    {
        $collection = $this->_companyCollectionFactory->create();
        $itemsArray = array();

        foreach ($collection as $item){

            $itemsArray [] = $this->getById($item->getId());
        }
        return $itemsArray;
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->_companyCollectionFactory->create();
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var CompanySearchResultsInterface $searchResults */
        $searchResults = $this->_companySearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}