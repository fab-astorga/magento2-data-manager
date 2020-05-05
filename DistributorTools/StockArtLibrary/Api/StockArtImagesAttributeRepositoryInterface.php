<?php

namespace DistributorTools\StockArtLibrary\Api;

/**
 * Interface StockArtImagesAttributeRepositoryInterface
 */
interface StockArtImagesAttributeRepositoryInterface
{

    /**
     * Save stock art images attribute
     *
     * @param string $title
     * @param string $urlImage
     * @return \DistributorTools\StockArtLibrary\Api\Data\StockArtImagesAttributeInterface
     */
    public function save($imageId, $title, $urlImage);

    /**
     * Retrieve stock art images attribute by id
     *
     * @param int $stockArtImagesAttributeId
     * @return \DistributorTools\StockArtLibrary\Api\Data\StockArtImagesAttributeInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($stockArtImagesAttributeId);

    /**
     * Retrieve stock art images attribute by attribute
     *
     * @param $value
     * @param string|null $attributeCode
     * @return \DistributorTools\StockArtLibrary\Api\Data\StockArtImagesAttributeInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($value, $attributeCode);

    /**
     * Delete $stockArtImagesAttribute.
     *
     * @param \DistributorTools\StockArtLibrary\Api\Data\StockArtImagesAttributeInterface $stockArtImagesAttribute
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\DistributorTools\StockArtLibrary\Api\Data\StockArtImagesAttributeInterface $stockArtImagesAttribute);

    /**
     * Delete stock art ImagesAttribute by ID.
     *
     * @param int $stockArtImagesAttributeId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($stockArtImagesAttributeId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \DistributorTools\StockArtLibrary\Api\Data\StockArtImagesAttributeSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}