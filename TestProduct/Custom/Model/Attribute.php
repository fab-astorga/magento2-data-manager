<?php

namespace TestProduct\Custom\Model;

class Attribute extends \Magento\Framework\Model\AbstractModel implements \TestProduct\Custom\Api\Data\AttributeInterface
{
    protected function _construct()
    {
        $this->_init('TestProduct\Custom\Model\ResourceModel\Attribute');
    }

    public function setEntityId($value)
    {
        return $this->setData('entity_id', $value);
    }

    public function getEntityId()
    {
        return $this->getData('entity_id');
    }

    public function setQty48($value)
    {
        return $this->setData('qty_48', $value);
    }

    public function getQty48()
    {
        return $this->getData('qty_48');
    }

    public function setQty144($value)
    {
        return $this->setData('qty_144', $value);
    }

    public function getQty144()
    {
        return $this->getData('qty_144');
    }

    public function setQty288($value)
    {
        return $this->setData('qty_288', $value);
    }

    public function getQty288()
    {
        return $this->getData('qty_288');
    }

    public function setQty576($value)
    {
        return $this->setData('qty_576', $value);
    }

    public function getQty576()
    {
        return $this->getData('qty_576');
    }

    public function setQty1008($value)
    {
        return $this->setData('qty_1008', $value);
    }

    public function getQty1008()
    {
        return $this->getData('qty_1008');
    }
}