<?php

namespace Services\CandyFillOptions\Model;

use Services\CandyFillOptions\Api\Data\CandyFillOptionsExtensionInterface;
use Services\CandyFillOptions\Api\Data\CandyFillOptionsInterface;
use Services\CandyFillOptions\Model\ResourceModel\CandyFillOptions as ResourceModelCandyFillOptions;
use \Magento\Framework\DataObject\IdentityInterface;
use \Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class CandyFillOptions
 */
class CandyFillOptions extends AbstractExtensibleModel implements CandyFillOptionsInterface, IdentityInterface
{
    const CACHE_TAG = 'candy_options';

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_cacheTag = 'candy_options';
    // @codingStandardsIgnoreEnd

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_eventPrefix = 'candy_options';
    // @codingStandardsIgnoreEnd

    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ResourceModelCandyFillOptions::class);
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
    public function getCategory()
    {
        return $this->_getData(self::CATEGORY);
    }

    /**
     * @inheritdoc
     */
    public function setCategory($category)
    {
        return $this->setData(self::CATEGORY, $category);
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
    public function setExtensionAttributes(CandyFillOptionsExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}