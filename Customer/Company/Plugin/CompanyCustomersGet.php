<?php

namespace Customer\Company\Plugin;

class CompanyCustomersGet
{
    protected $_customerCompanyExtensionFactory;
    protected $_customerManagement;
    protected $_addressCompanyRepository;
    protected $_searchCriteriaBuilder;
    protected $_filterBuilder;

    public function __construct (
        \Customer\Company\Api\Data\CustomerCompanyExtensionFactory $customerCompanyExtensionFactory,
        \Customer\Manager\Api\CustomerManagementInterface $customerManagement,
        \Customer\Company\Api\AddressCompanyRepositoryInterface $addressCompanyRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder
    ) {
        $this->_customerCompanyExtensionFactory = $customerCompanyExtensionFactory;
        $this->_customerManagement              = $customerManagement;
        $this->_addressCompanyRepository        = $addressCompanyRepository;
        $this->_searchCriteriaBuilder           = $searchCriteriaBuilder;
        $this->_filterBuilder                   = $filterBuilder;
    }

    public function afterGet (
        \Customer\Company\Api\CustomerCompanyRepositoryInterface $subject,
        \Customer\Company\Api\Data\CustomerCompanyInterface $company
    ) {
        $companyNetsuiteId = $company->getNetsuiteId();
        $customers = $this->_customerManagement->getAllCustomers();
        $companyCustomers = array();

        /** Insert company customers into the extension attributes */
        foreach ($customers as $customer)
        {
            if ($companyNetsuiteId == $customer->getExtensionAttributes()->getCustomerExtraAttributes()->getNetsuiteId()) {
                $companyCustomers[] = $customer;
            }
        }
        $extensionAttributes = $company->getExtensionAttributes();
        $companyExtension = $extensionAttributes ? $extensionAttributes : $this->_customerCompanyExtensionFactory->create();
        $companyExtension->setCompanyCustomers($companyCustomers);
        $company->setExtensionAttributes($companyExtension); 

        /** Insert company addresses into the extension attributes */
        $filter[] = $this->_filterBuilder
                        ->setField('company_id')
                        ->setValue($companyNetsuiteId)
                        ->setConditionType('eq')
                        ->create();
            
        $searchCriteria = $this->_searchCriteriaBuilder->addFilters($filter);
        $searchResults = $this->_addressCompanyRepository->getList($searchCriteria->create());
        $companyAddresses = $searchResults->getItems();

        $companyExtension->setCompanyAddresses($companyAddresses);
        $company->setExtensionAttributes($companyExtension);          

        return $company;
    }
}