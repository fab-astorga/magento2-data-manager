<?php

namespace ConfettiInserts\Manager\Model\ResourceModel\ConfettiInsertsPrices;

use ConfettiInserts\Manager\Model\ConfettiInsertsPrices as ModelConfettiInsertsPrices;
use ConfettiInserts\Manager\Model\ResourceModel\ConfettiInsertsPrices as ResourceModelConfettiInsertsPrices;
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