<?php

namespace Customers\Address\Api;

/**
 * Interface AddressDataRepositoryInterface
 */
interface AddressDataRepositoryInterface
{
    /**
     * Save address extra attributes
     *   
     * @param int $addressI
     * @param int $netsuiteId
     * @param string $address
     * @param string $aptSuite
     * @param string $state
     * @param boolean $isDefaultMyAddress
     * @return \Customers\Address\Api\Data\AddressDataInterface
     */
    public function save($addressId, $netsuiteId, $address, $aptSuite, $state, $isDefaultMyAddress);

    /**
     * Retrieve address extra attributes by id
     *
     * @param int $addressDataId
     * @return \Customers\Address\Api\Data\AddressDataInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($addressDataId);

    /**
     * Retrieve address extra attributes by attribute and value
     *
     * @param $value
     * @param string|null $attributeCode
     * @return \Customers\Address\Api\Data\AddressDataInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($value, $attributeCode);

    /**
     * Delete $addressData.
     *
     * @param \Customers\Address\Api\Data\AddressDataInterface $addressData
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Customers\Address\Api\Data\AddressDataInterface $addressData);

    /**
     * Delete address extra attributes by ID.
     *
     * @param int $addressDataId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($addressDataId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Customers\Address\Api\Data\AddressDataSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}