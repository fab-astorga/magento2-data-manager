<?php

namespace Customers\Contact\Api;

/**
 * Interface ContactRepositoryInterface
 */
interface ContactRepositoryInterface
{
    /**
     * Save customer extra attributes
     * @param string $email
     * @param int $netsuiteId
     * @param int $customerId
     * @param int $companyId
     * @param string $jobTitle
     * @param string $phone
     * @param boolean $access
     * @return \Customers\Contact\Api\Data\ContactInterface
     */
    public function save($email, $netsuiteId, $customerId, $companyId, $jobTitle, $phone, $access);

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
     * @return \Customers\Contact\Api\Data\ContactInterface[]
     */
    public function getCollection();


    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Customers\Contact\Api\Data\ContactSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}