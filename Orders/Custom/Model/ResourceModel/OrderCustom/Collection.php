<?php

namespace Orders\Custom\Model\ResourceModel\OrderCustom;

use Orders\Custom\Model\OrderCustom as ModelOrderCustom;
use Orders\Custom\Model\ResourceModel\OrderCustom as ResourceModelOrderCustom;
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
        $this->_init(ModelOrderCustom::class, ResourceModelOrderCustom::class);
    }
}