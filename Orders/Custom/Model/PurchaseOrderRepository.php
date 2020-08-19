<?php

namespace Orders\Custom\Model;

use Exception;
use Orders\Custom\Api\Data\PurchaseOrderInterface;
use Orders\Custom\Api\PurchaseOrderRepositoryInterface;
use Orders\Custom\Model\PurchaseOrderFactory;
use Orders\Custom\Model\ResourceModel\PurchaseOrder as ResourceModelPurchaseOrder;
use Orders\Custom\Model\ResourceModel\PurchaseOrder\Collection;
use Orders\Custom\Model\ResourceModel\PurchaseOrder\CollectionFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class PurchaseOrderRepository
 */
class PurchaseOrderRepository implements PurchaseOrderRepositoryInterface
{

    /**
     * @var PurchaseOrderFactory
     */
    private $_purchaseOrderFactory;

    /**
     * @var ResourceModelPurchaseOrder
     */
    private $_resourceModelPurchaseOrder;

    /**
     * PurchaseOrderRepository constructor.
     *
     * @param PurchaseOrderFactory $purchaseOrderFactory
     * @param ResourceModelPurchaseOrder $resourceModelPurchaseOrder
     */
    public function __construct (
        PurchaseOrderFactory $purchaseOrderFactory,
        ResourceModelPurchaseOrder $resourceModelPurchaseOrder
    ) {
        $this->_purchaseOrderFactory       = $purchaseOrderFactory;
        $this->_resourceModelPurchaseOrder = $resourceModelPurchaseOrder;
    }

    /**
     * Save purchase order
     *
     * @param int $orderId
     * @param int $netsuiteId
     * @param string $purchaseOrder
     * @return \Orders\Custom\Api\Data\PurchaseOrderInterface
     */
    public function save($orderId, $netsuiteId, $purchaseOrder)
    {
        $purchaseOrderEntity = $this->_purchaseOrderFactory->create();
        if (!$purchaseOrderEntity->getId()) {
            $purchaseOrderEntity = $this->_purchaseOrderFactory->create();
        }
        $purchaseOrderEntity->setOrderId($orderId);
        $purchaseOrderEntity->setNetsuiteId($netsuiteId);
        $purchaseOrderEntity->setPurchaseOrder($purchaseOrder);
        $this->_resourceModelPurchaseOrder->save($purchaseOrderEntity);
        return $purchaseOrderEntity;
    }

    /**
     * @inheritdoc
     */
    public function get($value, $attributeCode)
    {
        /** @var PurchaseOrder $purchaseOrder */
        $purchaseOrder = $this->_purchaseOrderFactory->create()->load($value, $attributeCode);

        if (!$purchaseOrder->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity'));
        }
        
        return $purchaseOrder;
    }

    /**
     * Retrieve order ID by netsuite ID
     * 
     * @param int $netsuiteId
     * @return int
     */
    public function getOrderIdByNetsuiteId($netsuiteId)
    {
        $purchaseOrder = $this->get($netsuiteId, 'netsuite_id');
        return $purchaseOrder->getOrderId();
    }
}