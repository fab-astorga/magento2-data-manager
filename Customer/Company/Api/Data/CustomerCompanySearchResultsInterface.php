<?php

namespace Customer\Company\Api\Data;

/**
 * Interface CustomerCompanySearchResultsInterface
 */
interface CustomerCompanySearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Customer\Company\Api\Data\CustomerCompanyInterface[]
     */
    public function getItems();

    /**
     * @param \Customer\Company\Api\Data\CustomerCompanyInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}