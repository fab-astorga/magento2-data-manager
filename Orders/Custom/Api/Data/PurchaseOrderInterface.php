<?php

namespace Orders\Custom\Api\Data;

/**
 * Interface PurchaseOrderInterface
 */
interface PurchaseOrderInterface
{
    const TABLE          = 'order_po';
    const ID             = 'id';
    const ORDER_ID       = 'order_id';
    const NETSUITE_ID    = 'netsuite_id';
    const PURCHASE_ORDER = 'purchase_order';    

    /**
     * Retrieve the order id
     *
     * @return int
     */
    public function getOrderId();

    /**
     * Set order id 
     *
     * @param int $orderId
     * @return $this
     */
    public function setOrderId($orderId);

    /**
     * Retrieve the netsuite id
     *
     * @return int
     */
    public function getNetsuiteId();

    /**
     * Set netsuite id 
     *
     * @param int $netsuiteId
     * @return $this
     */
    public function setNetsuiteId($netsuiteId);

    /**
     * Retrieve purchase order status
     *
     * @return string
     */
    public function getPurchaseOrder();

    /**
     * Set purchase order status
     *
     * @param string $purchaseOrder
     * @return $this
     */
    public function setPurchaseOrder($purchaseOrder);
}