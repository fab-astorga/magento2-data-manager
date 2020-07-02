<?php

namespace Customers\Company\Plugin;

use Magento\Framework\Exception\NoSuchEntityException;

class CompanyContactsGet
{
    const CUSTOMER_ID = 'customer_id';
    const COMPANY     = 'company';

    protected $_customerExtensionFactory;
    protected $_searchCriteriaBuilder;
    protected $_filterBuilder;
    protected $_companyRepository;
    protected $_companyFactory;
    protected $_companyExtensionFactory;
    protected $_contactManagement;
    protected $_addressExtensionFactory;
    protected $_addressDataCollection;
    protected $_customerDataRepository;
    protected $_logger;

    public function __construct (
        \Magento\Customer\Api\Data\CustomerExtensionFactory $customerExtensionFactory,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Customers\Company\Api\CompanyRepositoryInterface $companyRepository,
        \Customers\Company\Model\CompanyFactory $companyFactory,
        \Customers\Company\Api\Data\CompanyExtensionFactory $companyExtensionFactory,
        \Customers\Contact\Api\ContactManagementInterface $contactManagement,
        \Magento\Customer\Api\Data\AddressExtensionFactory $addressExtensionFactory,
        \Customers\Address\Model\ResourceModel\AddressData\CollectionFactory $addressDataCollection,
        \Customers\Contact\Api\CustomerDataRepositoryInterface $customerDataRepository,
        \File\CustomLog\Logger\Logger $logger
    ) {
        $this->_customerExtensionFactory = $customerExtensionFactory;
        $this->_searchCriteriaBuilder    = $searchCriteriaBuilder;
        $this->_filterBuilder            = $filterBuilder;
        $this->_companyRepository        = $companyRepository;
        $this->_companyFactory           = $companyFactory;
        $this->_companyExtensionFactory  = $companyExtensionFactory;
        $this->_contactManagement        = $contactManagement;
        $this->_addressExtensionFactory  = $addressExtensionFactory;
        $this->_addressDataCollection    = $addressDataCollection;
        $this->_customerDataRepository   = $customerDataRepository;
        $this->_logger                   = $logger;
    }

    public function afterGetCompany (
        \Customers\Company\Api\CompanyManagementInterface $subject,
        \Magento\Customer\Api\Data\CustomerInterface $customer
    ) 
    {
        try {

            $customerDataEntity = $this->_customerDataRepository->get(
                $customer->getId(), 
                self::CUSTOMER_ID
            );
    
            if ($customerDataEntity->getCustomerType() != self::COMPANY) {
                return 'customer is not a company';
            }

        } catch (NoSuchEntityException $e) {
            throw new NoSuchEntityException();
        }

        try {
            $company = $this->_companyRepository->get(
                $customer->getId(),
                self::CUSTOMER_ID
            );

            if (!$company->getId()) {
                throw new NoSuchEntityException();
            }

        } catch (NoSuchEntityException $e) {
            return $customer;
        }

        $extensionAttributes = $customer->getExtensionAttributes();
        $customerExtension = $extensionAttributes ? $extensionAttributes : $this->_customerExtensionFactory->create();

        $customerExtension->setCompany($company);
        $customer->setExtensionAttributes($customerExtension);

        /* Set contacts that belong to the company */
        $contacts = $this->_contactManagement->getAllContacts();
        $companyContacts = array();

        foreach ($contacts as $contact) 
        {
            if ($customer->getId() == $contact->getExtensionAttributes()->getContact()->getCompanyId()) {
                $companyContacts[] = $contact;
            }
        }

        $extensionAttributes = $company->getExtensionAttributes();
        $companyExtension = $extensionAttributes ? $extensionAttributes : $this->_companyExtensionFactory->create();
        $companyExtension->setContacts($companyContacts);
        $company->setExtensionAttributes($companyExtension);

        /** Set address extra attributes to each address of a customer */
        foreach ($customer->getAddresses() as $address)
        {
            $collection = $this->_addressDataCollection->create();

            foreach ($collection as $addressData)
            {
                if ($address->getId() == $addressData->getAddressId())
                {
                    $extensionAttributes = $address->getExtensionAttributes();
                    $addressExtension = $extensionAttributes ? $extensionAttributes : $this->_addressExtensionFactory->create(); 
                    $addressExtension->setAddressData($addressData);
                    $address->setExtensionAttributes($addressExtension);
                }
            }    
        }

        return $customer;
    }
}