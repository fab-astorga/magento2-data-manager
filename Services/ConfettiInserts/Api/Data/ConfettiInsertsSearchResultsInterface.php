<?php

namespace Services\ConfettiInserts\Api\Data;

/**
 * Interface ConfettiInsertsSearchResultsInterface
 */
interface ConfettiInsertsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Services\ConfettiInserts\Api\Data\ConfettiInsertsInterface[]
     */
    public function getItems();

    /**
     * @param \Services\ConfettiInserts\Api\Data\ConfettiInsertsInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}