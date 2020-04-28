<?php

namespace TestOrder\Custom\Model;

class Attribute extends \Magento\Framework\Model\AbstractModel implements \TestOrder\Custom\Api\Data\AttributeInterface
{
    protected function _construct()
    {
        $this->_init('TestOrder\Custom\Model\ResourceModel\Attribute');
    }

    public function setOrderId($value)
    {
        return $this->setData('order_id', $value);
    }

    public function getOrderId()
    {
        return $this->getData('order_id');
    }

    public function setBar($value)
    {
        return $this->setData('bar', $value);
    }

    public function getBar()
    {
        return $this->getData('bar');
    }
}