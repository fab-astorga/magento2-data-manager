<?php

namespace Customers\Company\Api\Data;

/**
 * Interface CompanySearchResultsInterface
 */
interface CompanySearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Customers\Company\Api\Data\CompanyInterface[]
     */
    public function getItems();

    /**
     * @param \Customers\Company\Api\Data\CompanyInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}