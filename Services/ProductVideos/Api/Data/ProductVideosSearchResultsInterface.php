<?php

namespace Services\ProductVideos\Api\Data;

/**
 * Interface ProductVideosSearchResultsInterface
 */
interface ProductVideosSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Services\ProductVideos\Api\Data\ProductVideosInterface[]
     */
    public function getItems();

    /**
     * @param \Services\ProductVideos\Api\Data\ProductVideosInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}