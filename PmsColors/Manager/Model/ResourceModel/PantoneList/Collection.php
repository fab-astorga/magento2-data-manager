<?php

namespace PmsColors\Manager\Model\ResourceModel\PantoneList;

use PmsColors\Manager\Model\PantoneList as ModelPantoneList;
use PmsColors\Manager\Model\ResourceModel\PantoneList as ResourceModelPantoneList;
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