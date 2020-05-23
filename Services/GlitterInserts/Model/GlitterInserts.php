<?php

namespace Services\GlitterInserts\Model;

use Services\GlitterInserts\Api\Data\GlitterInsertsExtensionInterface;
use Services\GlitterInserts\Api\Data\GlitterInsertsInterface;
use Services\GlitterInserts\Model\ResourceModel\GlitterInserts as ResourceModelGlitterInserts;
use \Magento\Framework\DataObject\IdentityInterface;
use \Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class GlitterInserts
 */
class GlitterInserts extends AbstractExtensibleModel implements GlitterInsertsInterface, IdentityInterface
{
    const CACHE_TAG = 'glitter_inserts';

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_cacheTag = 'glitter_inserts';
    // @codingStandardsIgnoreEnd

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_eventPrefix = 'glitter_inserts';
    // @codingStandardsIgnoreEnd

    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ResourceModelGlitterInserts::class);
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
    public function getType()
    {
        return $this->_getData(self::TYPE);
    }

    /**
     * @inheritdoc
     */
    public function setType($type)
    {
        return $this->setData(self::TYPE, $type);
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
    public function setExtensionAttributes(GlitterInsertsExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}