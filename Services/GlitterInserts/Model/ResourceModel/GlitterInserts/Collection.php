<?php

namespace Services\GlitterInserts\Model\ResourceModel\GlitterInserts;

use Services\GlitterInserts\Model\GlitterInserts as ModelGlitterInserts;
use Services\GlitterInserts\Model\ResourceModel\GlitterInserts as ResourceModelGlitterInserts;
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
        $this->_init(ModelGlitterInserts::class, ResourceModelGlitterInserts::class);
    }
}