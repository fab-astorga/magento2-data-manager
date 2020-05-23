<?php

namespace Services\HotChocolate\Api;

/**
 * Interface HotChocolateRepositoryInterface
 */
interface HotChocolateRepositoryInterface
{

    /**
     * Save hot chocolate
     *
     * @param int $id
     * @param string $sku
     * @param string $salesDescription
     * @param string $img
     * @param string $name
     * @param string $purchaseDescription
     * @return \Services\HotChocolate\Api\Data\HotChocolateInterface
     */
    public function save($id, $sku, $salesDescription, $img, $name, $purchaseDescription);

    /**
     * Retrieve hot chocolate by id
     *
     * @param int $hotChocolateId
     * @return \DistributorTools\StockArtLibrary\Api\Data\HotChocolateInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($hotChocolateId);

    /**
     * Delete hot chocolate by ID.
     *
     * @param int $hotChocolateId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($hotChocolateId);

    /**
     * Delete hot chocolates
     *
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete();

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Services\HotChocolate\Api\Data\HotChocolateSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}