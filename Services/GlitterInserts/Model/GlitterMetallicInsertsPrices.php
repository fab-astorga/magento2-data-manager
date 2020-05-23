<?php

namespace Services\GlitterInserts\Model;

use Services\GlitterInserts\Api\Data\GlitterMetallicInsertsPricesExtensionInterface;
use Services\GlitterInserts\Api\Data\GlitterMetallicInsertsPricesInterface;
use Services\GlitterInserts\Model\ResourceModel\GlitterMetallicInsertsPrices as ResourceModelGlitterMetallicInsertsPrices;
use \Magento\Framework\DataObject\IdentityInterface;
use \Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class GLitterMetallicInsertsPrices
 */
class GLitterMetallicInsertsPrices extends AbstractExtensibleModel implements GlitterMetallicInsertsPricesInterface, IdentityInterface
{
    const CACHE_TAG = 'glitter_metallic_inserts_prices';

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_cacheTag = 'glitter_metallic_inserts_prices';
    // @codingStandardsIgnoreEnd

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_eventPrefix = 'glitter_metallic_inserts_prices';
    // @codingStandardsIgnoreEnd

    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ResourceModelGlitterMetallicInsertsPrices::class);
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
    public function getCurrency()
    {
        return $this->_getData(self::CURRENCY);
    }

    /**
     * @inheritdoc
     */
    public function setCurrency($currency)
    {
        return $this->setData(self::CURRENCY, $currency);
    }

    /**
     * @inheritdoc
     */
    public function getPriceLevel()
    {
        return $this->_getData(self::PRICE_LEVEL);
    }

    /**
     * @inheritdoc
     */
    public function setPriceLevel($priceLevel)
    {
        return $this->setData(self::PRICE_LEVEL, $priceLevel);
    }

    /**
     * @inheritdoc
     */
    public function getMinQuantity()
    {
        return $this->_getData(self::MIN_QUANTITY);
    }

    /**
     * @inheritdoc
     */
    public function setMinQuantity($minQuantity)
    {
        return $this->setData(self::MIN_QUANTITY, $minQuantity);
    }

    /**
     * @inheritdoc
     */
    public function getUnitPrice()
    {
        return $this->_getData(self::UNIT_PRICE);
    }

    /**
     * @inheritdoc
     */
    public function setUnitPrice($unitPrice)
    {
        return $this->setData(self::UNIT_PRICE, $unitPrice);
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
    public function setExtensionAttributes(GlitterMetallicInsertsPricesExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}