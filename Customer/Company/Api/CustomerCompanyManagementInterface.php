<?php

namespace Customer\Company\Api;

interface CustomerCompanyManagementInterface 
{ 
    /**
     * Testing register customer company
     * 
     * @return boolean
     */
    public function registerCompanyTest();

    /**
     * Register customer company
     * 
     * @param int $netsuiteId
     * @param string $companyName
     * @param string $priceLevel
     * @param string $invoiceEmail
     * @param string $phone
     * @param string $altPhone
     * @param string $fax
     * @param string $additionalInvoiceEmailRecipient 
     * @param array $addresses
     * @return boolean
     */
    public function registerCompany($netsuiteId, $companyName, $priceLevel, $invoiceEmail, $phone, 
                                    $altPhone, $fax, $additionalInvoiceEmailRecipient, $addresses);

    /**
     * Get all companies
     * 
     * @return Customer\Company\Api\Data\CustomerCompanyInterface[]
     */
    public function getAllCompanies();
}