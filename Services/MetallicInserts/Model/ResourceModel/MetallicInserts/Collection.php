<?php

namespace Services\MetallicInserts\Model\ResourceModel\MetallicInserts;

use Services\MetallicInserts\Model\MetallicInserts as ModelMetallicInserts;
use Services\MetallicInserts\Model\ResourceModel\MetallicInserts as ResourceModelMetallicInserts;
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
        $this->_init(ModelMetallicInserts::class, ResourceModelMetallicInserts::class);
    }
}