<?php

namespace Customer\Company\Api;

/**
 * Interface AddressCompanyRepositoryInterface
 */
interface AddressCompanyRepositoryInterface
{
    /**
     * Save address company
     *   
     * @param int $companyId
     * @param string $address
     * @param string $aptSuite
     * @param string $city
     * @param string $state
     * @param string $zip
     * @param string $country
     * @param boolean $isDefaultMyAddress
     * @param boolean $isDefaultShipping
     * @param boolean $isDefaultBilling
     * @return \Customer\Company\Api\Data\AddressCompanyInterface
     */
    public function save($companyId, $address, $aptSuite, $city, $state, $zip, $country,
                                 $isDefaultMyAddress, $isDefaultShipping, $isDefaultBilling);

    /**
     * Retrieve address company by id
     *
     * @param int $addressCompanyId
     * @return \Customer\Company\Api\Data\AddressCompanyInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($addressCompanyId);

    /**
     * Retrieve address company by attribute and value
     *
     * @param $value
     * @param string|null $attributeCode
     * @return \Customer\Company\Api\Data\AddressCompanyInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($value, $attributeCode);

    /**
     * Delete $addressCompany.
     *
     * @param \Customer\Company\Api\Data\AddressCompanyInterface $addressCompany
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Customer\Company\Api\Data\AddressCompanyInterface $addressCompany);

    /**
     * Delete address company by ID.
     *
     * @param int $addressCompanyId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($addressCompanyId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Customer\Company\Api\Data\AddressCompanySearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}