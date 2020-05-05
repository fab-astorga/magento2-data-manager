<?php

namespace DistributorTools\StockArtLibrary\Api\Data;

/**
 * Interface StockArtImagesAttributeSearchResultsInterface
 */
interface StockArtImagesAttributeSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \DistributorTools\StockArtLibrary\Api\Data\StockArtImagesAttributeInterface[]
     */
    public function getItems();

    /**
     * @param \DistributorTools\StockArtLibrary\Api\Data\StockArtImagesAttributeInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}