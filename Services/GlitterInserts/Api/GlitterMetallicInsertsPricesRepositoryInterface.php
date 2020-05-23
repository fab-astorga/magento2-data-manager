<?php

namespace Services\GlitterInserts\Api;

/**
 * Interface GlitterMetallicInsertsPricesRepositoryInterface
 */
interface GlitterMetallicInsertsPricesRepositoryInterface
{
    /**
     * Save gliter metallic insert price
     *
     * @param int $id
     * @param string $sku
     * @param string $currency
     * @param string $priceLevel
     * @param int $minQuantity
     * @param float $unitPrice
     * @return \Services\GlitterInserts\Api\Data\GlitterMetalliInsertsPricesInterface
     */
    public function save($id, $sku, $currency, $priceLevel, $minQuantity, $unitPrice);

    /**
     * Retrieve gliter metallic insert price by id
     *
     * @param int $glitterMetallicInsertsPricesId
     * @return \DistributorTools\StockArtLibrary\Api\Data\GlitterMetallicInsertsPricesInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($glitterMetallicInsertsPricesId);

    /**
     * Delete gliter metallic insert price by ID.
     *
     * @param int $glitterMetallicInsertsPricesId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($glitterMetallicInsertsPricesId);

    /**
     * Delete gliter metallic inserts
     *
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete();

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Services\GlitterInserts\Api\Data\GlitterMetallicInsertsPricesSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}