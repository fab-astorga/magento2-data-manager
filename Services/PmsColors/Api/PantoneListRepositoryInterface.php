<?php

namespace Services\PmsColors\Api;

/**
 * Interface PantoneListRepositoryInterface
 */
interface PantoneListRepositoryInterface
{

    /**
     * Save pms color
     *
     * @param int $internalId
     * @param string $name
     * @param string $hexCode
     * @param int $r
     * @param int $g
     * @param int $b
     * @return \Services\PmsColors\Api\Data\PantoneListInterface
     */
    public function save($internalId, $name, $hexCode, $r, $g, $b);

    /**
     * Retrieve pms color by id
     *
     * @param int $pmsColorId
     * @return \DistributorTools\StockArtLibrary\Api\Data\PantoneListInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($pmsColorId);

    /**
     * Delete pms color by ID.
     *
     * @param int $pmsColorId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($pmsColorId);

    /**
     * Delete pms color collection
     *
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete();

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Services\PmsColors\Api\Data\PantoneListSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}