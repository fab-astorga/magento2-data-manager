<?php

namespace Customer\Company\Api;

/**
 * Interface CustomerCompanyRepositoryInterface
 */
interface CustomerCompanyRepositoryInterface
{
    /**
     * Save customer company
     * 
     * @param int $netsuiteId
     * @param string $companyName
     * @param string $priceLevel
     * @param string $invoiceEmail
     * @param string $phone
     * @param string $altPhone
     * @param string $fax
     * @param string $additionalInvoiceEmailRecipient
     * @return \Customer\Company\Api\Data\CustomerCompanyInterface
     */
    public function save($netsuiteId, $companyName, $priceLevel, $invoiceEmail, 
                             $phone, $altPhone, $fax, $additionalInvoiceEmailRecipient);

    /**
     * Retrieve customer company by id
     *
     * @param int $netsuiteId
     * @return \Customer\Company\Api\Data\CustomerCompanyInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($netsuiteId);

    /**
     * Retrieve customer company by attribute
     *
     * @param $value
     * @param string|null $attributeCode
     * @return \Customer\Company\Api\Data\CustomerCompanyInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($value, $attributeCode);

    /**
     * Delete $customerCompany.
     *
     * @param \Customer\Company\Api\Data\CustomerCompanyInterface $customerCompany
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Customer\Company\Api\Data\CustomerCompanyInterface $customerCompany);

    /**
     * Delete customer company by ID.
     *
     * @param int $netsuiteId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($netsuiteId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Customer\Company\Api\Data\CustomerCompanySearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}