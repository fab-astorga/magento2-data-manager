<?php

namespace Orders\Custom\Api;

/**
 * Interface PurchaseOrderRepositoryInterface
 */
interface PurchaseOrderRepositoryInterface
{
    /**
     * Save purchase order
     *
     * @param int $orderId
     * @param int $netsuiteId
     * @param string $purchaseOrder
     * @return \Orders\Custom\Api\Data\PurchaseOrderInterface
     */
    public function save($orderId, $netsuiteId, $purchaseOrder);

    /**
     * Retrieve purchase order by attribute
     *
     * @param $value
     * @param string|null $attributeCode
     * @return \Customer\Company\Api\Data\PurchaseOrderInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($value, $attributeCode);

    /**
     * Retrieve order ID by netsuite ID
     * 
     * @param int $netsuiteId
     * @return int
     */
    public function getOrderIdByNetsuiteId($netsuiteId);
}