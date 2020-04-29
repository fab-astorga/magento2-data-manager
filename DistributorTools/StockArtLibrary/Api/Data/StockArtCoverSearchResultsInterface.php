<?php

namespace DistributorTools\StockArtLibrary\Api\Data;

/**
 * Interface StockArtCoverSearchResultsInterface
 */
interface StockArtCoverSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \DistributorTools\StockArtLibrary\Api\Data\StockArtCoverInterface[]
     */
    public function getItems();

    /**
     * @param \DistributorTools\StockArtLibrary\Api\Data\StockArtCoverInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}