<?php

namespace Services\CandyFillOptions\Api;

/**
 * Interface CandyFillOptionsRepositoryInterface
 */
interface CandyFillOptionsRepositoryInterface
{
    /**
     * Save candy fill options
     *
     * @param int $id
     * @param string $sku
     * @param string $name
     * @param string $img
     * @param string $category
     * @param string $salesDescription
     * @param string $purchaseDescription
     * @return \Services\CandyFillOptions\Api\Data\CandyFillOptionsInterface
     */
    public function save($id, $sku, $name, $img, $category, $salesDescription, $purchaseDescription);

    /**
     * Retrieve candy fill options by id
     *
     * @param int $candyFillOptionsId
     * @return \DistributorTools\StockArtLibrary\Api\Data\CandyFillOptionsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($candyFillOptionsId);

    /**
     * Delete candy fill options by ID.
     *
     * @param int $candyFillOptionsId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($candyFillOptionsId);

    /**
     * Delete candy fill options
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete();

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Services\CandyFillOptions\Api\Data\CandyFillOptionsSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}