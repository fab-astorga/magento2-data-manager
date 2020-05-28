<?php

namespace Customers\Manager\Api;

interface CustomersManagementInterface 
{ 
    /**
     * Create new customer
     * 
     * @param string $email  
     * @param string $firstname
     * @param string $lastname
     * @param string $password
     * @return boolean
     */
    public function createCustomer($email, $firstname, $lastname, $password);

    /**
     * Get customer by email
     * 
     * @param string $email
     * @return \Magento\Customer\Api\Data\CustomerInterface
     */
    public function getCustomer($email);

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
    
    /**
     * Login customer
     * 
     * @param string $email
     * @param string $password
     * @return string
     */
    public function loginCustomer($email, $password);

    /**
     * Logout customer
     * 
     * @return int
     */
    public function logoutCustomer();
}