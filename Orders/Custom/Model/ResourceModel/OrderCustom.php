<?php

namespace Orders\Custom\Model\ResourceModel;

use Orders\Custom\Api\Data\OrderCustomInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class OrderCustom
 */
class OrderCustom extends AbstractDb
{
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(OrderCustomInterface::TABLE, OrderCustomInterface::ID);
    }
}