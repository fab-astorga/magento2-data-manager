<?php

namespace Orders\Custom\Model;

use Exception;
use Orders\Custom\Api\Data\OrderCustomInterface;
use Orders\Custom\Api\OrderCustomRepositoryInterface;
use Orders\Custom\Model\OrderCustomFactory;
use Orders\Custom\Model\ResourceModel\OrderCustom as ResourceModelOrderCustom;
use Orders\Custom\Model\ResourceModel\OrderCustom\Collection;
use Orders\Custom\Model\ResourceModel\OrderCustom\CollectionFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class OrderCustomRepository
 */
class OrderCustomRepository implements OrderCustomRepositoryInterface
{

    /**
     * @var OrderCustomFactory
     */
    private $_orderCustomFactory;

    /**
     * @var ResourceModelOrderCustom
     */
    private $_resourceModelOrderCustom;

    /**
     * OrderCustomRepository constructor.
     *
     * @param OrderCustomFactory $orderCustomFactory
     * @param ResourceModelOrderCustom $resourceModelOrderCustom
     */
    public function __construct (
        OrderCustomFactory $orderCustomFactory,
        ResourceModelOrderCustom $resourceModelOrderCustom
    ) {
        $this->_orderCustomFactory       = $orderCustomFactory;
        $this->_resourceModelOrderCustom = $resourceModelOrderCustom;
    }

    /**
     * Save purchase order
     *
     * @param int $orderId
     * @param int $netsuiteId
     * @param string $purchaseOrder
     * @param string $orderType
     * @return \Orders\Custom\Api\Data\OrderCustomInterface
     */
    public function save($orderId, $netsuiteId, $purchaseOrder, $orderType)
    {
        $orderCustomEntity = $this->_orderCustomFactory->create();
        if (!$orderCustomEntity->getId()) {
            $orderCustomEntity = $this->_orderCustomFactory->create();
        }
        $orderCustomEntity->setOrderId($orderId);
        $orderCustomEntity->setNetsuiteId($netsuiteId);
        $orderCustomEntity->setPurchaseOrder($purchaseOrder);
        $orderCustomEntity->setOrderType($orderType);
        $this->_resourceModelOrderCustom->save($orderCustomEntity);
        return $orderCustomEntity;
    }

    /**
     * @inheritdoc
     */
    public function get($value, $attributeCode)
    {
        /** @var OrderCustom $orderCustom */
        $orderCustom = $this->_orderCustomFactory->create()->load($value, $attributeCode);

        if (!$orderCustom->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity'));
        }
        
        return $orderCustom;
    }

    /**
     * Retrieve order ID by netsuite ID
     * 
     * @param int $netsuiteId
     * @return int
     */
    public function getOrderIdByNetsuiteId($netsuiteId)
    {
        $orderCustom = $this->get($netsuiteId, 'netsuite_id');
        return $orderCustom->getOrderId();
    }
}