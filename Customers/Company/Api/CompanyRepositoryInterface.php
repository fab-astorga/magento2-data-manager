<?php

namespace Customers\Company\Api;

/**
 * Interface CompanyRepositoryInterface
 */
interface CompanyRepositoryInterface
{
    /**
     * Save company
     * 
     * @param int $customerId
     * @param int $netsuiteId
     * @param string $companyName
     * @param string $invoiceEmail
     * @param string $businessPhone
     * @param string $stateSalesTaxLicense
     * @param string $websiteAddress
     * @param string $preferredModeOfDelivery
     * @param string $altPhone
     * @param string $fax
     * @param string $priceLevel
     * @param string $additionalInvoiceEmailRecipient
     * @param boolean $access 
     * @return \Customers\Company\Api\Data\CompanyInterface
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
    );

    /**
     * Retrieve company by id
     *
     * @param int $netsuiteId
     * @return \Customers\Company\Api\Data\CompanyInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($netsuiteId);

    /**
     * Retrieve company by attribute
     *
     * @param $value
     * @param string|null $attributeCode
     * @return \Customers\Company\Api\Data\CompanyInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($value, $attributeCode);

    /**
     * Delete $customerCompany.
     *
     * @param \Customers\Company\Api\Data\CustomerCompanyInterface $company
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\CustomerS\Company\Api\Data\CompanyInterface $company);

    /**
     * Retrieve magento customer through netsuite ID
     *
     * @param int $netsuiteId
     * @return \Magento\Customer\Api\Data\CustomerInterface
     */
    public function getCustomerByNetsuiteId($netsuiteId);

    /**
     * @return \Customers\Company\Api\Data\CompanyInterface[]
     */
    public function getCollection();

    /**
     * Delete company by ID.
     *
     * @param int $netsuiteId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($netsuiteId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Customers\Company\Api\Data\CompanySearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}