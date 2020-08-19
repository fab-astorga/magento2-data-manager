<?php

namespace Orders\Custom\Model;

use Orders\Custom\Api\Data\PurchaseOrderInterface;
use Orders\Custom\Model\ResourceModel\PurchaseOrder as ResourceModelPurchaseOrder;
use \Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class PurchaseOrder
 */
class PurchaseOrder extends AbstractExtensibleModel implements PurchaseOrderInterface
{
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ResourceModelPurchaseOrder::class);
    }

    /**
     * @inheritdoc
     */
    public function getOrderId()
    {
        return $this->_getData(PurchaseOrderInterface::ORDER_ID);
    }

    /**
     * @inheritdoc
     */
    public function setOrderId($orderId)
    {
        return $this->setData(PurchaseOrderInterface::ORDER_ID, $orderId);
    }

    /**
     * @inheritdoc
     */
    public function getNetsuiteId()
    {
        return $this->_getData(PurchaseOrderInterface::NETSUITE_ID);
    }

    /**
     * @inheritdoc
     */
    public function setNetsuiteId($netsuiteId)
    {
        return $this->setData(PurchaseOrderInterface::NETSUITE_ID, $netsuiteId);
    }

    /**
     * @inheritdoc
     */
    public function getPurchaseOrder()
    {
        return $this->_getData(PurchaseOrderInterface::PURCHASE_ORDER);
    }

    /**
     * @inheritdoc
     */
    public function setPurchaseOrder($purchaseOrder)
    {
        return $this->setData(PurchaseOrderInterface::PURCHASE_ORDER, $purchaseOrder);
    }
}