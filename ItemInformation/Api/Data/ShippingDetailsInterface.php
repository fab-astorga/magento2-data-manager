<?php
namespace Items\ItemInformation\Api\Data;

Interface ShippingDetailsInterface extends \Magento\Framework\Api\ExtensibleDataInterface {
    
    /**#@+
     * Constants defined for keys of  data array
     */
    const ITEM_ID = 'item_id';

    const SCHEDULE_B_NUMBER = 'schedule_b_number';

    const INDIVIDUAL_ITEM_WEIGHT_OZ = 'individual_item_weight_oz';

    const GIFT_BOX_WEIGHT_OZ = 'gift_box_weight_oz';

    const TOTAL_ITEM_WEIGHT = 'total_item_weight';

    const TOTAL_ITEM_WEIGHT_UNIT = 'total_item_weight_unit';

    const ITEMS_PER_CARTON = 'items_per_carton';

    const GIFT_BOX_COLOR = 'gift_box_color';

    const PACKAGE = 'package';

    const CARTON_SIZE = 'carton_size';

    const ADDITIONAL_SHIPPING_COSTS = 'additional_shipping_costs';

    const CARTON_WEIGHT_OZ = 'carton_weight_oz';

    const TOTAL_CARTON_WEIGHT_LBS = 'total_carton_weight_lbs';

    const SHIPPING_DATA_VERIFIED = 'shipping_data_verified';

    const TOTAL_CARTON_PER_PALLET = 'total_cartons_per_pallet';

    const PACK_OUT_QUANTITY = 'pack_out_quantity';

    const ICE_PACK_REQUIRED = 'ice_pack_required';

    const ATTRIBUTES = [
        self::ITEM_ID,
        self::SCHEDULE_B_NUMBER,
        self::INDIVIDUAL_ITEM_WEIGHT_OZ,
        self::GIFT_BOX_WEIGHT_OZ,
        self::TOTAL_ITEM_WEIGHT,
        self::TOTAL_ITEM_WEIGHT_UNIT,
        self::ITEMS_PER_CARTON,
        self::GIFT_BOX_COLOR,
        self::PACKAGE,
        self::CARTON_SIZE,
        self::ADDITIONAL_SHIPPING_COSTS,
        self::CARTON_WEIGHT_OZ,
        self::TOTAL_CARTON_WEIGHT_LBS,
        self::SHIPPING_DATA_VERIFIED,
        self::TOTAL_CARTON_PER_PALLET,
        self::PACK_OUT_QUANTITY,
        self::ICE_PACK_REQUIRED,
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
     * Set schedule_b_number
     * @param string $value
     * @return $this
     */
    public function setScheduleBNumber($value);

    /**
     * get schedule_b_number
     * @return string
     */
    public function getScheduleBNumber();

    /**
     * Set individual_item_weight_oz
     * @param float $value
     * @return $this
     */
    public function setIndividualItemWeightOz($value);

    /**
     * get individual_item_weight_oz
     * @return float
     */
    public function getIndividualItemWeightOz();

    /**
     * Set gift_box_weight_oz
     * @param float $value
     * @return $this
     */
    public function setGiftBoxWeightOz($value);

    /**
     * get gift_box_weight_oz
     * @return float
     */
    public function getGiftBoxWeightOz();

    /**
     * Set total_item_weight
     * @param float $value
     * @return $this
     */
    public function setTotalItemWeight($value);

    /**
     * get total_item_weight
     * @return float
     */
    public function getTotalItemWeight();

    /**
     * Set total_item_weight_unit
     * @param string $value
     * @return $this
     */
    public function setTotalItemWeightUnit($value);

    /**
     * get total_item_weight_unit
     * @return string
     */
    public function getTotalItemWeightUnit();

    /**
     * Set items_per_carton
     * @param int $value
     * @return $this
     */
    public function setItemsPerCarton($value);

    /**
     * get items_per_carton
     * @return int
     */
    public function getItemsPerCarton();

    /**
     * Set gift_box_color
     * @param string $value
     * @return $this
     */
    public function setGiftBoxColor($value);

    /**
     * get gift_box_color
     * @return string
     */
    public function getGiftBoxColor();

    /**
     * Set package
     * @param string $value
     * @return $this
     */
    public function setPackage($value);

    /**
     * get package
     * @return string
     */
    public function getPackage();

    /**
     * Set carton_size
     * @param string $value
     * @return $this
     */
    public function setCartonSize($value);

    /**
     * get carton_size
     * @return string
     */
    public function getCartonSize();

    /**
     * Set additional_shipping_costs
     * @param string $value
     * @return $this
     */
    public function setAdditionalShippingCosts($value);

    /**
     * get additional_shipping_costs
     * @return string
     */
    public function getAdditionalShippingCosts();

    /**
     * Set carton_weight_oz
     * @param float $value
     * @return $this
     */
    public function setCartonWeightOz($value);

    /**
     * get carton_weight_oz
     * @return float
     */
    public function getCartonWeightOz();

    /**
     * Set total_carton_weight_lbs
     * @param float $value
     * @return $this
     */
    public function setTotalCartonWeightLbs($value);

    /**
     * get total_carton_weight_lbs
     * @return float
     */
    public function getTotalCartonWeightLbs();

    /**
     * Set shipping_data_verified
     * @param bool $value
     * @return $this
     */
    public function setShippingDataVerified($value);

    /**
     * get shipping_data_verified
     * @return bool
     */
    public function getShippingDataVerified();

    /**
     * Set total_cartons_per_pallet
     * @param int $value
     * @return $this
     */
    public function setTotalCartonsPerPallet($value);

    /**
     * get total_cartons_per_pallet
     * @return int
     */
    public function getTotalCartonsPerPallet();

    /**
     * Set pack_out_quantity
     * @param int $value
     * @return $this
     */
    public function setPackOutQuantity($value);

    /**
     * get pack_out_quantity
     * @return int
     */
    public function getPackOutQuantity();

    /**
     * Set ice_pack_required
     * @param boolean $value
     * @return $this
     */
    public function setIcePackRequired($value);

    /**
     * get ice_pack_required
     * @return boolean
     */
    public function getIcePackRequired();

    /**
     * @return \Items\ItemInformation\Api\Data\ShippingDetailsExtensionInterface|null
     */
    public function getExtensionAttributes();
 
    /**
     * @param \Items\ItemInformation\Api\Data\ShippingDetailsExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\ShippingDetailsExtensionInterface $extensionAttributes);

}