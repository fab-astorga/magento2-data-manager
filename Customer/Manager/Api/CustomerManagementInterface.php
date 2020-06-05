<?php

namespace Customer\Manager\Api;

interface CustomerManagementInterface 
{ 
    /**
     * Test function for register customer
     * 
     * @return boolean
     */
    public function registerCustomerTest();

    /**
     * Create new customer
     * 
     * @param string $email  
     * @param string $firstname
     * @param string $lastname
     * @param string $password
     * @param int $netsuiteId
     * @param string $role
     * @param string $jobTitle
     * @param boolean $permission
     * @param array $addresses
     * @return boolean
     */
    public function registerCustomer(
        $email, 
        $firstname, 
        $lastname, 
        $password,  
        $netsuiteId, 
        $role, 
        $jobTitle, 
        $permission,
        $addresses
    );

    /**
     * Get customer by email
     * 
     * @param string $email
     * @return \Magento\Customer\Api\Data\CustomerInterface
     */
    public function getCustomer($email);

    /**
     * Get all customers
     * 
     * @return \Magento\Customer\Api\Data\CustomerInterface[]
     */
    public function getAllCustomers();

    /**
     * Delete customer by email
     * 
     * @param string $email
     * @return boolean
     */
    public function deleteCustomer($email);

    /**
     * Update customer
     * 
     * @param string $email
     * @param string $firstname
     * @param string $lastname
     * @return boolean
     */
    public function updateCustomer($email, $firstname, $lastname);

    /**
     * Change password customer
     * 
     * @param string $email
     * @param string $actualPassword
     * @param string $newPassword
     * @return boolean
     */
    public function changePasswordCustomer($email, $actualPassword, $newPassword);


    /*****************************  SESSION MANAGEMENT ****************************************/    
    /**
     * Login customer
     * 
     * @param string $email
     * @param string $password
     * @return \Magento\Customer\Api\Data\CustomerInterface
     */
    public function loginCustomer($email, $password);

    /**
     * Logout customer
     * 
     * @return string
     */
    public function logoutCustomer();
}