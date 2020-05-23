<?php

namespace Services\CandyFillOptions\Api\Data;

/**
 * Interface CandyFillOptionsPricesSearchResultsInterface
 */
interface CandyFillOptionsPricesSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Services\CandyFillOptions\Api\Data\CandyFillOptionsPricesInterface[]
     */
    public function getItems();

    /**
     * @param \Services\CandyFillOptions\Api\Data\CandyFillOptionsPricesInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}