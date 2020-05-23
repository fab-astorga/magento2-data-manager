<?php

namespace Services\GlitterInserts\Api\Data;

/**
 * Interface GlitterInsertsSearchResultsInterface
 */
interface GlitterInsertsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Services\GlitterInserts\Api\Data\GlitterInsertsInterface[]
     */
    public function getItems();

    /**
     * @param \Services\GlitterInserts\Api\Data\GlitterInsertsInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}