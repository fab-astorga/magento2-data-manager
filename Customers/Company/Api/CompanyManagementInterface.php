<?php

namespace Customers\Company\Api;

/**
 * Interface CompanyManagementInterface
 * @api
 */
interface CompanyManagementInterface 
{ 
    /**
     * Testing registration
     * 
     * @return boolean
     */
    public function registerCompanyTest();

    /**
     * Register company
     * 
     * @param string $companyName
     * @param string $username
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
     * @param array $addresses
     * @return boolean
     */
    public function sendFormData(
        $companyName, 
        $username, 
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
        $addresses
    );

    /**
     * The company will save and will be synchronized if happens in Netsuite
     * 
     * @return boolean
     */
    public function saveCompanyNetsuite();

    /**
     * The company will update and will be synchronized if happens in Netsuite
     * 
     * @return boolean
     */
    public function updateCompanyNetsuite();

    /**
     * Get company by email
     * 
     * @param string $email
     * @return \Magento\Customer\Api\Data\CustomerInterface
     */
    public function getCompany($email);

    /**
     * Get all companies
     * 
     * @return \Magento\Customer\Api\Data\CustomerInterface[]
     */
    public function getAllCompanies();

    /**
     * Delete company in Magento and Netsuite
     * 
     * @param int $netsuiteId
     * @param int $contactId
     * @return boolean
     */
    public function deleteCompany();

    /**
     * Update Company
     * 
     * @param string $email
     * @param string $firstname
     * @param string $lastname
     * @param string $companyName
     * @param string $businessPhone
     * @param string $address
     * @param string $zipcode
     * @param string $country
     * @param string $state
     * @param string $city
     * @return boolean
     */
    public function updateCompany($email, $firstname, $lastname, $companyName, $businessPhone, $address, $zipcode, $country, $state, $city);

    /**
     * Change password company
     * 
     * @param string $email
     * @param string $actualPassword
     * @param string $newPassword
     * @return boolean
     */
    public function changePasswordCompany($email, $actualPassword, $newPassword);

    /*****************************  SESSION MANAGEMENT ****************************************/    
    /**
     * Login company
     * 
     * @param string $email
     * @param string $password
     * @param int|null $wishlistId
     * @return \Customers\Company\Api\Data\CompanyInterface|string
     */
    public function loginCompany($email, $password);

    /**
     * Logout company
     * 
     * @return string
     */
    public function logoutCompany();
}