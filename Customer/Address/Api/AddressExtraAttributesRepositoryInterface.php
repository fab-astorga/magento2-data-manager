<?php

namespace Customer\Address\Api;

/**
 * Interface AddressExtraAttributesRepositoryInterface
 */
interface AddressExtraAttributesRepositoryInterface
{
    /**
     * Save address extra attributes
     *   
     * @param int $addressId
     * @param string $address
     * @param string $aptSuite
     * @param string $state
     * @param boolean $isDefaultMyAddress
     * @return \Customer\Address\Api\Data\AddressExtraAttributesInterface
     */
    public function save($addressId, $address, $aptSuite, $state, $isDefaultMyAddress);

    /**
     * Retrieve address extra attributes by id
     *
     * @param int $addressExtraAttributesId
     * @return \Customer\Address\Api\Data\AddressExtraAttributesInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($addressExtraAttributesId);

    /**
     * Retrieve address extra attributes by attribute and value
     *
     * @param $value
     * @param string|null $attributeCode
     * @return \Customer\Address\Api\Data\AddressExtraAttributesInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($value, $attributeCode);

    /**
     * Delete $addressExtraAttributes.
     *
     * @param \Customer\Address\Api\Data\AddressExtraAttributesInterface $addressExtraAttributes
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Customer\Address\Api\Data\AddressExtraAttributesInterface $addressExtraAttributes);

    /**
     * Delete address extra attributes by ID.
     *
     * @param int $addressExtraAttributesId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($addressExtraAttributesId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Customer\Address\Api\Data\AddressExtraAttributesSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}