<?php

namespace Services\ConfettiInserts\Model\ResourceModel\ConfettiInsertsPrices;

use Services\ConfettiInserts\Model\ConfettiInsertsPrices as ModelConfettiInsertsPrices;
use Services\ConfettiInserts\Model\ResourceModel\ConfettiInsertsPrices as ResourceModelConfettiInsertsPrices;
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
        $this->_init(ModelConfettiInsertsPrices::class, ResourceModelConfettiInsertsPrices::class);
    }
}