<?php

namespace DistributorTools\FlyersEblasts\Api;

/**
 * Interface FlyersEblastsRepositoryInterface
 */
interface FlyersEblastsRepositoryInterface
{
    /**
     * Save flyers eblasts
     *
     * @param string $id
     * @param string $name
     * @param string $img
     * @return \DistributorTools\FlyersEblasts\Api\Data\FlyersEblastsInterface
     */
    public function save($id, $name, $img);

    /**
     * Retrieve flyers eblasts by id
     *
     * @param int $flyersEblastsId
     * @return \DistributorTools\StockArtLibrary\Api\Data\FlyersEblastsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($flyersEblastsId);

    /**
     * Delete flyers eblasts by ID.
     *
     * @param int $flyersEblastsId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($flyersEblastsId);

    /**
     * Delete flyers eblasts.
     *
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete();

    /**
     * Return flyers eblasts according to one or more filters
     * 
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \DistributorTools\FlyersEblasts\Api\Data\FlyersEblastsSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}