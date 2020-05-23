<?php

namespace Services\ConfettiInserts\Api;

/**
 * Interface ConfettiInsertsPricesRepositoryInterface
 */
interface ConfettiInsertsPricesRepositoryInterface
{

    /**
     * Save confetti insert price
     *
     * @param int $id
     * @param string $sku
     * @param string $currency
     * @param string $priceLevel
     * @param int $minQuantity
     * @param float $unitPrice
     * @return \Services\ConfettiInserts\Api\Data\ConfettiInsertsPricesInterface
     */
    public function save($id, $sku, $currency, $priceLevel, $minQuantity, $unitPrice);

    /**
     * Retrieve confetti insert price by id
     *
     * @param int $confettiInsertsPricesId
     * @return \DistributorTools\StockArtLibrary\Api\Data\ConfettiInsertsPricesInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($confettiInsertsPricesId);

    /**
     * Delete confetti insert price by ID.
     *
     * @param int $confettiInsertsPricesId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($confettiInsertsPricesId);

    /**
     * Delete confetti inserts
     *
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete();

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Services\ConfettiInserts\Api\Data\ConfettiInsertsPricesSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}