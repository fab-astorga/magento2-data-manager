<?php

namespace ConfettiInserts\Manager\Model;

use ConfettiInserts\Manager\Api\Data\ConfettiInsertsExtensionInterface;
use ConfettiInserts\Manager\Api\Data\ConfettiInsertsInterface;
use ConfettiInserts\Manager\Model\ResourceModel\ConfettiInserts as ResourceModelConfettiInserts;
use \Magento\Framework\DataObject\IdentityInterface;
use \Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class ConfettiInserts
 */
class ConfettiInserts extends AbstractExtensibleModel implements ConfettiInsertsInterface, IdentityInterface
{
    const CACHE_TAG = 'confetti_inserts';

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_cacheTag = 'confetti_inserts';
    // @codingStandardsIgnoreEnd

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_eventPrefix = 'confetti_inserts';
    // @codingStandardsIgnoreEnd

    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ResourceModelConfettiInserts::class);
    }

    /**
     * @inheritdoc
     */
    public function getSku()
    {
        return $this->_getData(self::SKU);
    }

    /**
     * @inheritdoc
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
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

    /**
     * @inheritdoc
     */
    public function getSubcategory()
    {
        return $this->_getData(self::SUBCATEGORY);
    }

    /**
     * @inheritdoc
     */
    public function setSubcategory($subcategory)
    {
        return $this->setData(self::SUBCATEGORY, $subcategory);
    }

    /**
     * @inheritdoc
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @inheritdoc
     */
    public function setExtensionAttributes(ConfettiInsertsExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}