<?php

namespace DistributorTools\FlyersEblasts\Model;

use DistributorTools\FlyersEblasts\Api\Data\FlyersEblastsInterface;
use DistributorTools\FlyersEblasts\Model\ResourceModel\FlyersEblasts as ResourceModelFlyersEblasts;
use \Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class FlyersEblasts
 */
class FlyersEblasts extends AbstractExtensibleModel implements FlyersEblastsInterface
{
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ResourceModelFlyersEblasts::class);
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
    public function getImg()
    {
        return $this->_getData(self::IMG);
    }

    /**
     * @inheritdoc
     */
    public function setImg($img)
    {
        return $this->setData(self::IMG, $img);
    }
}