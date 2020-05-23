<?php

namespace Services\ConfettiInserts\Model\ResourceModel\ConfettiInserts;

use Services\ConfettiInserts\Model\ConfettiInserts as ModelConfettiInserts;
use Services\ConfettiInserts\Model\ResourceModel\ConfettiInserts as ResourceModelConfettiInserts;
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
        $this->_init(ModelConfettiInserts::class, ResourceModelConfettiInserts::class);
    }
}