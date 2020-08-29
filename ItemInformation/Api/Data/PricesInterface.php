<?php
namespace Items\ItemInformation\Api\Data;

Interface PricesInterface extends \Magento\Framework\Api\ExtensibleDataInterface {
    
    /**#@+
     * Constants defined for keys of  data array
     */
    const ITEM_ID = 'item_id';
    const MIN_QUANTITY = 'min_quantity';
    const UNIT_PRICE = 'unit_price';


    const ATTRIBUTES = [
        self::ITEM_ID,
        self::MIN_QUANTITY,
        self::UNIT_PRICE,
    ];

    /**
     * Set item_id
     * @param int $value
     * @return $this
     */
    public function setItemId($value);

    /**
     * get item_id
     * @return int
     */
    public function getItemId();

    /**
     * Set min_quantity
     * @param int $value
     * @return $this
     */
    public function setMinQuantity($value);

    /**
     * get min_quantity
     * @return int
     */
    public function getMinQuantity();

    /**
     * Set unit_price
     * @param float $value
     * @return $this
     */
    public function setUnitPrice($value);

    /**
     * get unit_price
     * @return float
     */
    public function getUnitPrice();

    /**
     * @return \Items\ItemInformation\Api\Data\PricesExtensionInterface|null
     */
    public function getExtensionAttributes();
 
    /**
     * @param \Items\ItemInformation\Api\Data\PricesExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\PricesExtensionInterface $extensionAttributes);

}