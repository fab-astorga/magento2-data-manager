<?php

namespace Services\CandyFillOptions\Model\ResourceModel\CandyFillOptionsPrices;

use Services\CandyFillOptions\Model\CandyFillOptionsPrices as ModelCandyFillOptionsPrices;
use Services\CandyFillOptions\Model\ResourceModel\CandyFillOptionsPrices as ResourceModelCandyFillOptionsPrices;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * Initialize resource model collection
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ModelCandyFillOptionsPrices::class, ResourceModelCandyFillOptionsPrices::class);
    }
}