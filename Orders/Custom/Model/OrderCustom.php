<?php

namespace Orders\Custom\Model;

use Orders\Custom\Api\Data\OrderCustomInterface;
use Orders\Custom\Model\ResourceModel\OrderCustom as ResourceModelOrderCustom;
use \Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class OrderCustom
 */
class OrderCustom extends AbstractExtensibleModel implements OrderCustomInterface
{
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ResourceModelOrderCustom::class);
    }

    /**
     * @inheritdoc
     */
    public function getOrderId()
    {
        return $this->_getData(OrderCustomInterface::ORDER_ID);
    }

    /**
     * @inheritdoc
     */
    public function setOrderId($orderId)
    {
        return $this->setData(OrderCustomInterface::ORDER_ID, $orderId);
    }

    /**
     * @inheritdoc
     */
    public function getNetsuiteId()
    {
        return $this->_getData(OrderCustomInterface::NETSUITE_ID);
    }

    /**
     * @inheritdoc
     */
    public function setNetsuiteId($netsuiteId)
    {
        return $this->setData(OrderCustomInterface::NETSUITE_ID, $netsuiteId);
    }

    /**
     * @inheritdoc
     */
    public function getPurchaseOrder()
    {
        return $this->_getData(OrderCustomInterface::PURCHASE_ORDER);
    }

    /**
     * @inheritdoc
     */
    public function setPurchaseOrder($purchaseOrder)
    {
        return $this->setData(OrderCustomInterface::PURCHASE_ORDER, $purchaseOrder);
    }

    /**
     * @inheritdoc
     */
    public function getOrderType()
    {
        return $this->_getData(OrderCustomInterface::ORDER_TYPE);
    }

    /**
     * @inheritdoc
     */
    public function setOrderType($orderType)
    {
        return $this->setData(OrderCustomInterface::ORDER_TYPE, $orderType);
    }
}