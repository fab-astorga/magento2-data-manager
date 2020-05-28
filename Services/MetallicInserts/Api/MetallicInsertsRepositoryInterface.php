<?php

namespace Services\MetallicInserts\Api;

/**
 * Interface MetallicInsertsRepositoryInterface
 */
interface MetallicInsertsRepositoryInterface
{

    /**
     * Save metallic insert
     *
     * @param int $id
     * @param string $sku
     * @param string $name
     * @param string $img
     * @return \Services\MetallicInserts\Api\Data\MetallicInsertsInterface
     */
    public function save($id, $sku, $name, $img);

    /**
     * Retrieve metallic insert by id
     *
     * @param int $metallicInsertsId
     * @return \DistributorTools\StockArtLibrary\Api\Data\MetallicInsertsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($metallicInsertsId);

    /**
     * Delete metallic insert by ID.
     *
     * @param int $metallicInsertsId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($metallicInsertsId);

    /**
     * Delete metallic inserts
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete();

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Services\MetallicInserts\Api\Data\MetallicInsertsSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}