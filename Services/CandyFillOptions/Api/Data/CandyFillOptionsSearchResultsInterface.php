<?php

namespace Services\CandyFillOptions\Api\Data;

/**
 * Interface CandyFillOptionsSearchResultsInterface
 */
interface CandyFillOptionsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Services\CandyFillOptions\Api\Data\CandyFillOptionsInterface[]
     */
    public function getItems();

    /**
     * @param \Services\CandyFillOptions\Api\Data\CandyFillOptionsInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}