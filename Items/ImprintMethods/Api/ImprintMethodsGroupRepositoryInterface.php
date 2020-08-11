<?php

namespace Items\ImprintMethods\Api;
use Items\ImprintMethods\Api\Data\ImprintMethodGroupInterface;
/**
 * Interface ImprintMethodsGroupRepositoryInterface
 */
interface ImprintMethodsGroupRepositoryInterface
{
    /**
     * Save imprint method group
     *
     * @param int $netsuiteId
     * @param string $Name
     * @return \Items\ImprintMethods\Api\Data\ImprintMethodGroupInterface
     */
    public function save($netsuiteId, $name);

    /**
     * Retrieve imprint method group by id
     *
     * @param int $imprintMethodsGroupId
     * @return \Items\ImprintMethods\Api\Data\ImprintMethodGroupInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($imprintMethodsGroupId);

    /**
     * Delete imprint method group by ID.
     *
     * @param int $imprintMethodsGroupId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($imprintMethodsGroupId);

    /**
     * Delete imprint methods
     * @param ImprintMethodGroupInterface $imprintMethodGroup
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(ImprintMethodGroupInterface $imprintMethodGroup);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Items\ImprintMethods\Api\Data\ImprintMethodGroupSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}