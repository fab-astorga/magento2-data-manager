<?php

namespace Services\PmsColors\Api\Data;

/**
 * Interface PantoneListSearchResultsInterface
 */
interface PantoneListSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Services\PmsColors\Api\Data\PantoneListInterface[]
     */
    public function getItems();

    /**
     * @param \Services\PmsColors\Api\Data\PantoneListInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}