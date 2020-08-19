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
     * @return \Magento\Customer\Api\Data\CustomerInterface
     */
    public function registerContact();

    /**
     * update contact
     * @return boolean
     */
    public function updateContactNetsuite();

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
     * @return boolean
     */
    public function deleteContact();

    /**
     * Update contact
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
    public function updateContact($email, $firstname, $lastname, $companyName, $businessPhone, $address, $zipcode, $country, $state, $city);

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