<?php

namespace Services\ProductVideos\Model\ResourceModel\ProductVideos;

use Services\ProductVideos\Model\ProductVideos as ModelProductVideos;
use Services\ProductVideos\Model\ResourceModel\ProductVideos as ResourceModelProductVideos;
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
        $this->_init(ModelProductVideos::class, ResourceModelProductVideos::class);
    }
}