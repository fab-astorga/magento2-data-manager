<?php

namespace Services\GlitterInserts\Api\Data;

/**
 * Interface GlitterMetallicInsertsPricesSearchResultsInterface
 */
interface GlitterMetallicInsertsPricesSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Services\GlitterInserts\Api\Data\GlitterMetallicInsertsPricesInterface[]
     */
    public function getItems();

    /**
     * @param \Services\GlitterInserts\Api\Data\GlitterMetallicInsertsPricesInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}