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
     * @param string $name
     * @param string $urlImage
     * @return \DistributorTools\StockArtLibrary\Api\Data\StockArtCoverInterface
     */
    public function save($name, $urlImage);

    /**
     * Retrieve stock art cover by id
     *
     * @param int $stockArtCoverId
     * @return \DistributorTools\StockArtLibrary\Api\Data\StockArtCoverInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($stockArtCoverId);

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
     * @param \DistributorTools\StockArtLibrary\Api\Data\StockArtCoverInterface $stockArtCover
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\DistributorTools\StockArtLibrary\Api\Data\StockArtCoverInterface $stockArtCover);

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