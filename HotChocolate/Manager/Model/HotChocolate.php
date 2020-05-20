<?php

namespace HotChocolate\Manager\Model;

use HotChocolate\Manager\Api\Data\HotChocolateExtensionInterface;
use HotChocolate\Manager\Api\Data\HotChocolateInterface;
use HotChocolate\Manager\Model\ResourceModel\HotChocolate as ResourceModelHotChocolate;
use \Magento\Framework\DataObject\IdentityInterface;
use \Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class HotChocolate
 */
class HotChocolate extends AbstractExtensibleModel implements HotChocolateInterface, IdentityInterface
{
    const CACHE_TAG = 'hot_chocolate';

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_cacheTag = 'hot_chocolate';
    // @codingStandardsIgnoreEnd

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_eventPrefix = 'hot_chocolate';
    // @codingStandardsIgnoreEnd

    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ResourceModelHotChocolate::class);
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
    public function getSalesDescription()
    {
        return $this->_getData(self::SALES_DESCRIPTION);
    }

    /**
     * @inheritdoc
     */
    public function setSalesDescription($salesDescription)
    {
        return $this->setData(self::SALES_DESCRIPTION, $salesDescription);
    }

    /**
     * @inheritdoc
     */
    public function getPurchaseDescription()
    {
        return $this->_getData(self::PURCHASE_DESCRIPTION);
    }

    /**
     * @inheritdoc
     */
    public function setPurchaseDescription($purchaseDescription)
    {
        return $this->setData(self::PURCHASE_DESCRIPTION, $purchaseDescription);
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
    public function setExtensionAttributes(HotChocolateExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}