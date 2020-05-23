<?php

namespace DistributorTools\FlyersEblasts\Model\ResourceModel\FlyersEblasts;

use DistributorTools\FlyersEblasts\Model\FlyersEblasts as ModelFlyersEblasts;
use DistributorTools\FlyersEblasts\Model\ResourceModel\FlyersEblasts as ResourceModelFlyersEblasts;
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
        $this->_init(ModelFlyersEblasts::class, ResourceModelFlyersEblasts::class);
    }
}