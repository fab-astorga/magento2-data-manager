<?php

namespace Services\ProductVideos\Model\ResourceModel;

use Services\ProductVideos\Api\Data\ProductVideosInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class ProductVideos
 */
class ProductVideos extends AbstractDb
{
    protected $_isPkAutoIncrement = false;
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ProductVideosInterface::TABLE, ProductVideosInterface::ID);
    }
}