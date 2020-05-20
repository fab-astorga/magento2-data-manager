<?php

namespace HotChocolate\Manager\Api;

/**
 * Interface HotChocolateRepositoryInterface
 */
interface HotChocolateRepositoryInterface
{

    /**
     * Save confetti insert
     *
     * @param string $sku
     * @param string $salesDescription
     * @param string $img
     * @param string $name
     * @param string $purchaseDescription
     * @return \HotChocolate\Manager\Api\Data\HotChocolateInterface
     */
    public function save($sku, $salesDescription, $img, $name, $purchaseDescription);

    /**
     * Retrieve confetti insert by id
     *
     * @param int $hotChocolateId
     * @return \DistributorTools\StockArtLibrary\Api\Data\HotChocolateInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($hotChocolateId);

    /**
     * Delete confetti insert by ID.
     *
     * @param int $hotChocolateId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($hotChocolateId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \HotChocolate\Manager\Api\Data\HotChocolateSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}