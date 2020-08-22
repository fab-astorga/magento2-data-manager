<?php

namespace Orders\Custom\Api;

/**
 * Interface OrderCustomRepositoryInterface
 */
interface OrderCustomRepositoryInterface
{
    /**
     * Save purchase order
     *
     * @param int $orderId
     * @param int $netsuiteId
     * @param string $purchaseOrder
     * @param string $orderType
     * @return \Orders\Custom\Api\Data\OrderCustomInterface
     */
    public function save($orderId, $netsuiteId, $purchaseOrder, $orderType);

    /**
     * Retrieve purchase order by attribute
     *
     * @param $value
     * @param string|null $attributeCode
     * @return \Customer\Company\Api\Data\OrderCustomInterface
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