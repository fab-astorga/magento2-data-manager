<?php

namespace Services\CandyFillOptions\Model;

use Services\CandyFillOptions\Api\Data\CandyFillOptionsPricesExtensionInterface;
use Services\CandyFillOptions\Api\Data\CandyFillOptionsPricesInterface;
use Services\CandyFillOptions\Model\ResourceModel\CandyFillOptionsPrices as ResourceModelCandyFillOptionsPrices;
use \Magento\Framework\DataObject\IdentityInterface;
use \Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class CandyFillOptionsPrices
 */
class CandyFillOptionsPrices extends AbstractExtensibleModel implements CandyFillOptionsPricesInterface, IdentityInterface
{
    const CACHE_TAG = 'candy_options_prices';

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_cacheTag = 'candy_options_prices';
    // @codingStandardsIgnoreEnd

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_eventPrefix = 'candy_options_prices';
    // @codingStandardsIgnoreEnd

    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ResourceModelCandyFillOptionsPrices::class);
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
    public function setExtensionAttributes(CandyFillOptionsPricesExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}