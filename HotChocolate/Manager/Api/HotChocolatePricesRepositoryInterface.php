<?php

namespace HotChocolate\Manager\Api;

/**
 * Interface HotChocolatePricesRepositoryInterface
 */
interface HotChocolatePricesRepositoryInterface
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
     * @return \HotChocolate\Manager\Api\Data\HotChocolatePricesInterface
     */
    public function save($id, $sku, $currency, $priceLevel, $minQuantity, $unitPrice);

    /**
     * Retrieve confetti insert price by id
     *
     * @param int $hotChocolatePricesId
     * @return \DistributorTools\StockArtLibrary\Api\Data\HotChocolatePricesInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($hotChocolatePricesId);

    /**
     * Delete confetti insert price by ID.
     *
     * @param int $hotChocolatePricesId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($hotChocolatePricesId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \HotChocolate\Manager\Api\Data\HotChocolatePricesSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}