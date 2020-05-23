<?php

namespace Services\PmsColors\Model\ResourceModel\PantoneList;

use Services\PmsColors\Model\PantoneList as ModelPantoneList;
use Services\PmsColors\Model\ResourceModel\PantoneList as ResourceModelPantoneList;
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
        $this->_init(ModelPantoneList::class, ResourceModelPantoneList::class);
    }
}