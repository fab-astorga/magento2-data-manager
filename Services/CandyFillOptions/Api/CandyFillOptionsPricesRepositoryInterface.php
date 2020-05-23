<?php

namespace Services\CandyFillOptions\Api;

/**
 * Interface CandyFillOptionsPricesRepositoryInterface
 */
interface CandyFillOptionsPricesRepositoryInterface
{

    /**
     * Save candy fill options price
     *
     * @param int $id
     * @param string $sku
     * @param string $currency
     * @param string $priceLevel
     * @param int $minQuantity
     * @param float $unitPrice
     * @return \Services\CandyFillOptions\Api\Data\CandyFillOptionsPricesInterface
     */
    public function save($id, $sku, $currency, $priceLevel, $minQuantity, $unitPrice);

    /**
     * Retrieve candy fill options price by id
     *
     * @param int $candyFillOptionsPricesId
     * @return \DistributorTools\StockArtLibrary\Api\Data\CandyFillOptionsPricesInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($candyFillOptionsPricesId);

    /**
     * Delete candy fill options price by ID.
     *
     * @param int $candyFillOptionsPricesId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($candyFillOptionsPricesId);

    /**
     * Delete candy fill options
     *
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete();

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Services\CandyFillOptions\Api\Data\CandyFillOptionsPricesSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}