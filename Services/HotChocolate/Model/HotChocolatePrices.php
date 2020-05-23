<?php

namespace Services\HotChocolate\Model;

use Services\HotChocolate\Api\Data\HotChocolatePricesExtensionInterface;
use Services\HotChocolate\Api\Data\HotChocolatePricesInterface;
use Services\HotChocolate\Model\ResourceModel\HotChocolatePrices as ResourceModelHotChocolatePrices;
use \Magento\Framework\DataObject\IdentityInterface;
use \Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class HotChocolatePrices
 */
class HotChocolatePrices extends AbstractExtensibleModel implements HotChocolatePricesInterface, IdentityInterface
{
    const CACHE_TAG = 'hot_chocolate_prices';

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_cacheTag = 'hot_chocolate_prices';
    // @codingStandardsIgnoreEnd

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_eventPrefix = 'hot_chocolate_prices';
    // @codingStandardsIgnoreEnd

    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ResourceModelHotChocolatePrices::class);
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
    public function setExtensionAttributes(HotChocolatePricesExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}