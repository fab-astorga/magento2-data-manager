<?php

namespace Customer\Manager\Api;

/**
 * Interface CustomerExtraAttributesRepositoryInterface
 */
interface CustomerExtraAttributesRepositoryInterface
{
    /**
     * Save customer extra attributes
     *      *
     * @param int $customerId
     * @param int $netsuiteId
     * @param string $role
     * @param string $jobTitle
     * @param boolean $permission
     * @return \Customer\Manager\Api\Data\CustomerExtraAttributesInterface
     */
    public function save($customerId, $netsuiteId, $role, $jobTitle, $permission);

    /**
     * Retrieve customer extra attributes by id
     *
     * @param int $customerExtraAttributesId
     * @return \Customer\Manager\Api\Data\CustomerExtraAttributesInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($customerExtraAttributesId);

    /**
     * Retrieve customer extra attributes by attribute and value
     *
     * @param $value
     * @param string|null $attributeCode
     * @return \Customer\Manager\Api\Data\CustomerExtraAttributesInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($value, $attributeCode);

    /**
     * Delete $customerExtraAttributes.
     *
     * @param \Customer\Manager\Api\Data\CustomerExtraAttributesInterface $customerExtraAttributes
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Customer\Manager\Api\Data\CustomerExtraAttributesInterface $customerExtraAttributes);

    /**
     * Delete customer extra attributes by ID.
     *
     * @param int $customerExtraAttributesId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($customerExtraAttributesId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Customer\Manager\Api\Data\CustomerExtraAttributesSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}