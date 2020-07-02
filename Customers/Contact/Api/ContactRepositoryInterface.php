<?php

namespace Customers\Contact\Api;

/**
 * Interface ContactRepositoryInterface
 */
interface ContactRepositoryInterface
{
    /**
     * Save customer extra attributes
     * 
     * @param int $netsuiteId
     * @param int $customerId
     * @param int $companyId
     * @param string $jobTitle
     * @return \Customers\Contact\Api\Data\ContactInterface
     */
    public function save($netsuiteId, $customerId, $companyId, $jobTitle);

    /**
     * Retrieve customer extra attributes by id
     *
     * @param int $contactId
     * @return \Customers\Contact\Api\Data\ContactInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($contactId);

    /**
     * Retrieve customer extra attributes by attribute and value
     *
     * @param $value
     * @param string|null $attributeCode
     * @return \Customers\Contact\Api\Data\ContactInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($value, $attributeCode);

    /**
     * Delete $contact.
     *
     * @param \Customers\Contact\Api\Data\ContactInterface $contact
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Customers\Contact\Api\Data\ContactInterface $contact);

    /**
     * Delete customer extra attributes by ID.
     *
     * @param int $contactId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($contactId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Customers\Contact\Api\Data\ContactSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}