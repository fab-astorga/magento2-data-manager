<?php

namespace ConfettiInserts\Manager\Api;

/**
 * Interface ConfettiInsertsRepositoryInterface
 */
interface ConfettiInsertsRepositoryInterface
{

    /**
     * Save confetti insert
     *
     * @param string $sku
     * @param string $name
     * @param string $img
     * @param string $subcategory
     * @return \ConfettiInserts\Manager\Api\Data\ConfettiInsertsInterface
     */
    public function save($sku, $name, $img, $subcategory);

    /**
     * Retrieve confetti insert by id
     *
     * @param int $confettiInsertsId
     * @return \DistributorTools\StockArtLibrary\Api\Data\ConfettiInsertsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($confettiInsertsId);

    /**
     * Delete confetti insert by ID.
     *
     * @param int $confettiInsertsId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($confettiInsertsId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \ConfettiInserts\Manager\Api\Data\ConfettiInsertsSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}