<?php

namespace Services\CandyFillOptions\Model\ResourceModel\CandyFillOptions;

use Services\CandyFillOptions\Model\CandyFillOptions as ModelCandyFillOptions;
use Services\CandyFillOptions\Model\ResourceModel\CandyFillOptions as ResourceModelCandyFillOptions;
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
        $this->_init(ModelCandyFillOptions::class, ResourceModelCandyFillOptions::class);
    }
}