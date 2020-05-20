<?php

namespace PmsColors\Manager\Api\Data;

/**
 * Interface PantoneListSearchResultsInterface
 */
interface PantoneListSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \PmsColors\Manager\Api\Data\PantoneListInterface[]
     */
    public function getItems();

    /**
     * @param \PmsColors\Manager\Api\Data\PantoneListInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}