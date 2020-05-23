<?php

namespace Services\MetallicInserts\Api\Data;

/**
 * Interface MetallicInsertsSearchResultsInterface
 */
interface MetallicInsertsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Services\MetallicInserts\Api\Data\MetallicInsertsInterface[]
     */
    public function getItems();

    /**
     * @param \Services\MetallicInserts\Api\Data\MetallicInsertsInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}