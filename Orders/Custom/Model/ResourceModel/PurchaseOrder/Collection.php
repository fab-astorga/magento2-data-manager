<?php

namespace Orders\Custom\Model\ResourceModel\PurchaseOrder;

use Orders\Custom\Model\PurchaseOrder as ModelPurchaseOrder;
use Orders\Custom\Model\ResourceModel\PurchaseOrder as ResourceModelPurchaseOrder;
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
        $this->_init(ModelPurchaseOrder::class, ResourceModelPurchaseOrder::class);
    }
}