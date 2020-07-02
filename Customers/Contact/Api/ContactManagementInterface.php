<?php

namespace Customers\Contact\Api;

interface ContactManagementInterface 
{ 
    /**
     * Test function for register contact customer
     * 
     * @return \Magento\Customer\Api\Data\CustomerInterface
     */
    public function registerContactTest();

    /**
     * Create new contact
     * 
     * @param string $email  
     * @param string $firstname
     * @param string $lastname
     * @param string $password
     * @param int $netsuiteId
     * @param int $companyId
     * @param string $jobTitle
     * @param array $addresses
     * @return \Magento\Customer\Api\Data\CustomerInterface
     */
    public function registerContact(
        $email, 
        $firstname, 
        $lastname, 
        $password, 
        $netsuiteId, 
        $companyId,
        $jobTitle, 
        $addresses
    );

    /**
     * Get contact by email
     * 
     * @param string $email
     * @return \Magento\Customer\Api\Data\CustomerInterface
     */
    public function getContact($email);

    /**
     * Get all contacts
     * 
     * @return \Magento\Customer\Api\Data\CustomerInterface[]
     */
    public function getAllContacts();

    /**
     * Delete contact by email
     * 
     * @param string $email
     * @return boolean
     */
    public function deleteContact($email);

    /**
     * Update contact
     * 
     * @param string $email
     * @param string $firstname
     * @param string $lastname
     * @return boolean
     */
    public function updateContact($email, $firstname, $lastname);

    /**
     * Change password contact
     * 
     * @param string $email
     * @param string $actualPassword
     * @param string $newPassword
     * @return boolean
     */
    public function changePasswordContact($email, $actualPassword, $newPassword);


    /*****************************  SESSION MANAGEMENT ****************************************/    
    /**
     * Login contact
     * 
     * @param string $email
     * @param string $password
     * @return \Magento\Customer\Api\Data\CustomerInterface
     */
    public function loginContact($email, $password);

    /**
     * Logout contact
     * 
     * @return string
     */
    public function logoutContact();
}