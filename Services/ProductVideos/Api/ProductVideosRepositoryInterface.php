<?php

namespace Services\ProductVideos\Api;

/**
 * Interface ProductVideosRepositoryInterface
 */
interface ProductVideosRepositoryInterface
{
    /**
     * Save product video
     *
     * @param string $id
     * @param string $name
     * @param string $img
     * @param string $video
     * @return \Services\ProductVideos\Api\Data\ProductVideosInterface
     */
    public function save($id, $name, $img, $video);

    /**
     * Retrieve product video by id
     *
     * @param int $productVideoId
     * @return \DistributorTools\StockArtLibrary\Api\Data\ProductVideosInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($productVideoId);

    /**
     * Delete product video by ID.
     *
     * @param int $productVideoId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($productVideoId);

    /**
     * Delete product video by ID.
     *
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete();

    /**
     * Return product videos according to one or more filters
     * 
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Services\ProductVideos\Api\Data\ProductVideosSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}