<?php

namespace Services\HotChocolate\Api;

/**
 * Interface HotChocolatePricesRepositoryInterface
 */
interface HotChocolatePricesRepositoryInterface
{

    /**
     * Save hot chocolate price
     *
     * @param int $id
     * @param string $sku
     * @param string $currency
     * @param string $priceLevel
     * @param int $minQuantity
     * @param float $unitPrice
     * @return \Services\HotChocolate\Api\Data\HotChocolatePricesInterface
     */
    public function save($id, $sku, $currency, $priceLevel, $minQuantity, $unitPrice);

    /**
     * Retrieve hot chocolate price by id
     *
     * @param int $hotChocolatePricesId
     * @return \DistributorTools\StockArtLibrary\Api\Data\HotChocolatePricesInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($hotChocolatePricesId);

    /**
     * Delete hot chocolate price by ID.
     *
     * @param int $hotChocolatePricesId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($hotChocolatePricesId);

    /**
     * Delete hot chocolate prices
     *
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete();

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Services\HotChocolate\Api\Data\HotChocolatePricesSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}