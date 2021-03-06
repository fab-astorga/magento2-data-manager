<?php

namespace DistributorTools\StockArtLibrary\Api;

/**
 * Interface StockArtCoverRepositoryInterface
 */
interface StockArtCoverRepositoryInterface
{

    /**
     * Save stock art cover
     *
     * @param int $id
     * @param string $name
     * @param string $thumbnail
     * @param string $img
     * @return \DistributorTools\StockArtLibrary\Api\Data\StockArtCoverInterface
     */
    public function save($id, $name, $thumbnail, $img);

    /**
     * Retrieve stock art cover by id
     *
     * @param int $stockArtCoverId
     * @return \DistributorTools\StockArtLibrary\Api\Data\StockArtCoverInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($stockArtCoverId);

    /**
     * Retrieve all stock art library
     *
     * @return \DistributorTools\StockArtLibrary\Api\Data\StockArtCoverInterface[]
     */
    public function getAll();

    /**
     * Retrieve stock art cover by attribute
     *
     * @param $value
     * @param string|null $attributeCode
     * @return \DistributorTools\StockArtLibrary\Api\Data\StockArtCoverInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($value, $attributeCode);

    /**
     * Delete $stockArtCover.
     *
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete();

    /**
     * Delete stock art cover by ID.
     *
     * @param int $stockArtCoverId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($stockArtCoverId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \DistributorTools\StockArtLibrary\Api\Data\StockArtCoverSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}