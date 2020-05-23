<?php

namespace Services\GlitterInserts\Api;

/**
 * Interface GlitterInsertsRepositoryInterface
 */
interface GlitterInsertsRepositoryInterface
{

    /**
     * Save glitter insert
     *
     * @param string $sku
     * @param string $name
     * @param string $img
     * @param string $type
     * @return \Services\GlitterInserts\Api\Data\GlitterInsertsInterface
     */
    public function save($sku, $name, $img, $type);

    /**
     * Retrieve glitter insert by id
     *
     * @param int $glitterInsertsId
     * @return \DistributorTools\StockArtLibrary\Api\Data\GlitterInsertsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($glitterInsertsId);

    /**
     * Delete glitter insert by ID.
     *
     * @param int $glitterInsertsId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($glitterInsertsId);

    /**
     * Delete glitter inserts
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete();

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Services\GlitterInserts\Api\Data\GlitterInsertsSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}