<?php

namespace Services\GlitterInserts\Model\ResourceModel\GlitterMetallicInsertsPrices;

use Services\GlitterInserts\Model\GlitterMetallicInsertsPrices as ModelGlitterMetallicInsertsPrices;
use Services\GlitterInserts\Model\ResourceModel\GlitterMetallicInsertsPrices as ResourceModelGlitterMetallicInsertsPrices;
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
        $this->_init(ModelGlitterMetallicInsertsPrices::class, ResourceModelGlitterMetallicInsertsPrices::class);
    }
}