<?php

namespace Items\ImprintMethods\Api\Data;

/**
 * Interface ImprintMethodGroupSearchResultsInterface
 */
interface ImprintMethodGroupSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Items\ImprintMethods\Api\Data\ImprintMethodGroupInterface[]
     */
    public function getItems();

    /**
     * @param \Items\ImprintMethods\Api\Data\ImprintMethodGroupInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}