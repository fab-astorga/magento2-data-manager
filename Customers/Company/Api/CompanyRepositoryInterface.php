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
     * @param string $username
     * @param string $password
     * @param string $primaryContact
     * @param string $jobTitle
     * @param string $invoiceEmail
     * @param string $businessPhone
     * @param string $extension
     * @param string $stateSalesTaxLicense
     * @param string $websiteAddress
     * @param string $preferredModeOfDelivery
     * @param string $howDidYouHearAboutUs
     * @param string $altPhone
     * @param string $fax
     * @param string $priceLevel
     * @param string $role
     * @param string $additionalInvoiceEmailRecipient
     * @param boolean $permission 
     * @param boolean $existsInNetsuite
     * @return \Customers\Company\Api\Data\CompanyInterface
     */
    public function save(
        $customerId,
        $netsuiteId, 
        $companyName, 
        $username, 
        $password, 
        $primaryContact,                                    
        $jobTitle, 
        $invoiceEmail, 
        $businessPhone, 
        $extension,            
        $stateSalesTaxLicense, 
        $websiteAddress, 
        $preferredModeOfDelivery,                             
        $howDidYouHearAboutUs, 
        $altPhone, 
        $fax, 
        $priceLevel, 
        $role,                            
        $additionalInvoiceEmailRecipient, 
        $permission,
        $existsInNetsuite
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