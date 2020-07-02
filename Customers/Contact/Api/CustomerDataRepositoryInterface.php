<?php

namespace Customers\Contact\Api;

/**
 * Interface CustomerDataRepositoryInterface
 */
interface CustomerDataRepositoryInterface
{
    /**
     * Save customer data
     * 
     * @param int $customerId
     * @param string $customerType
     * @return \Customers\Contact\Api\Data\CustomerDataInterface
     */
    public function save($customerId, $customerType);

    /**
     * Retrieve customer data by id
     *
     * @param int $id
     * @return \Customers\Contact\Api\Data\CustomerDataInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * Retrieve customer data by attribute and value
     *
     * @param $value
     * @param string|null $attributeCode
     * @return \Customers\Contact\Api\Data\CustomerDataInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($value, $attributeCode);

    /**
     * Delete $customerData.
     *
     * @param \Customers\Contact\Api\Data\CustomerDataInterface $customerData
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Customers\Contact\Api\Data\CustomerDataInterface $customerData);

    /**
     * Delete customer data by ID.
     *
     * @param int $id
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Customers\Contact\Api\Data\CustomerDataSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}