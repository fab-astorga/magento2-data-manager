<?php

namespace Services\PmsColors\Model;

use Services\PmsColors\Api\Data\PantoneListInterface;
use Services\PmsColors\Model\ResourceModel\PantoneList as ResourceModelPantoneList;
use \Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class PantoneList
 */
class PantoneList extends AbstractExtensibleModel implements PantoneListInterface
{
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ResourceModelPantoneList::class);
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->_getData(self::NAME);
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritdoc
     */
    public function getHexCode()
    {
        return $this->_getData(self::HEX_CODE);
    }

    /**
     * @inheritdoc
     */
    public function setHexCode($hexCode)
    {
        return $this->setData(self::HEX_CODE, $hexCode);
    }

    /**
     * @inheritdoc
     */
    public function getR()
    {
        return $this->_getData(self::R);
    }

    /**
     * @inheritdoc
     */
    public function setR($r)
    {
        return $this->setData(self::R, $r);
    }

    /**
     * @inheritdoc
     */
    public function getG()
    {
        return $this->_getData(self::G);
    }

    /**
     * @inheritdoc
     */
    public function setG($g)
    {
        return $this->setData(self::G, $g);
    }

    /**
     * @inheritdoc
     */
    public function getB()
    {
        return $this->_getData(self::B);
    }

    /**
     * @inheritdoc
     */
    public function setB($b)
    {
        return $this->setData(self::B, $b);
    }
}