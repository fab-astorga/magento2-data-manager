<?php

namespace Orders\Custom\Model\ResourceModel;

use Orders\Custom\Api\Data\PurchaseOrderInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class PurchaseOrder
 */
class PurchaseOrder extends AbstractDb
{
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(PurchaseOrderInterface::TABLE, PurchaseOrderInterface::ID);
    }
}