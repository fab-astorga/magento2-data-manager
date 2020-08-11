<?php
namespace Items\ItemInformation\Api\Data;

Interface ItemDetailsInterface extends \Magento\Framework\Api\ExtensibleDataInterface {
    
    /**#@+
     * Constants defined for keys of  data array
     */
    const ITEM_ID = 'item_id';

    const SALES_DESCRIPTION = 'sales_description';

    const ITEM_PMS_COLOR = 'item_pms_color';

    const ITEM_VOLUME_IN_OZ = 'item_volume_in_oz';

    const ITEM_PACKAGING = 'item_packaging';

    const ITEM_MATERIAL = 'item_material';

    const ITEM_GUSSET = 'item_gusset';

    const ITEM_HANDLE_LENGTH = 'item_handle_length';

    const ITEM_DEPTH = 'item_depth';

    const ITEM_WIDTH = 'item_width';

    const ITEM_HEIGHT = 'item_height';

    const ITEM_TOP_DIAMETER = 'item_top_diameter';

    const ITEM_BOTTOM_DIAMETER = 'item_bottom_diameter';

    const ITEM_LENGTH = 'item_length';

    const ITEM_DIAMETER = 'item_diameter';

    const FITS_CAR_CUP_HOLDER = 'fits_car_cup_holder';

    const MICROWAVE_SAFE = 'microwave_safe';

    const TOP_RACK_DISHWASHER_SAFE = 'top_rack_dishwasher_safe';

    const CARABINER_INCLUDED = 'carabiner_included';

    const SPILL_PROOF = 'spill_proof';

    const SPILL_PRESISTANT = 'spill_persistant';

    const HANDWASH_ONLY = 'handwash_only';

    const PATENT_NUMBER = 'patent_number';

    const RECYCLE_NUMBER = 'recycle_number';

    const MAH = 'mah';

    const BATTERIES_INCLUDED = 'batteries_included';

    const ATTRIBUTES = [
        self::ITEM_ID,
        self::SALES_DESCRIPTION,
        self::ITEM_PMS_COLOR,
        self::ITEM_VOLUME_IN_OZ,
        self::ITEM_PACKAGING,
        self::ITEM_MATERIAL,
        self::ITEM_GUSSET,
        self::ITEM_HANDLE_LENGTH,
        self::ITEM_DEPTH,
        self::ITEM_WIDTH,
        self::ITEM_HEIGHT,
        self::ITEM_TOP_DIAMETER,
        self::ITEM_BOTTOM_DIAMETER,
        self::ITEM_LENGTH,
        self::ITEM_DIAMETER,
        self::FITS_CAR_CUP_HOLDER,
        self::MICROWAVE_SAFE,
        self::TOP_RACK_DISHWASHER_SAFE,
        self::CARABINER_INCLUDED,
        self::SPILL_PROOF,
        self::SPILL_PRESISTANT,
        self::HANDWASH_ONLY,
        self::PATENT_NUMBER,
        self::RECYCLE_NUMBER,
        self::MAH,
        self::BATTERIES_INCLUDED,
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
     * Set sales_description
     * @param string $value
     * @return $this
     */
    public function setSalesDescription($value);

    /**
     * get sales_description
     * @return string
     */
    public function getSalesDescription();

    /**
     * Set item_pms_color
     * @param string $value
     * @return $this
     */
    public function setItemPMSColor($value);

    /**
     * get item_pms_color
     * @return string
     */
    public function getItemPMSColor();

    /**
     * Set item_volume_in_oz
     * @param float $value
     * @return $this
     */
    public function setItemVolumeInOz($value);

    /**
     * get item_volume_in_oz
     * @return float
     */
    public function getItemVolumeInOz();

    /**
     * Set item_packaging
     * @param string $value
     * @return $this
     */
    public function setItemPackaging($value);

    /**
     * get item_packaging
     * @return string
     */
    public function getPackaging();

    /**
     * Set item_material
     * @param string $value
     * @return $this
     */
    public function setItemMaterial($value);

    /**
     * get item_material
     * @return string
     */
    public function getItemMaterial();

    /**
     * Set item_gusset
     * @param int $value
     * @return $this
     */
    public function setItemGusset($value);

    /**
     * get item_gusset
     * @return int
     */
    public function getItemGusset();

    /**
     * Set item_handle_length
     * @param int $value
     * @return $this
     */
    public function setItemHandleLength($value);

    /**
     * get item_handle_length
     * @return int
     */
    public function getItemHandleLength();

    /**
     * Set item_depth
     * @param float $value
     * @return $this
     */
    public function setItemDepth($value);

    /**
     * get item_depth
     * @return float
     */
    public function getItemDepth();

    /**
     * Set item_width
     * @param float $value
     * @return $this
     */
    public function setItemWidth($value);

    /**
     * get item_width
     * @return float
     */
    public function getItemWidth();

    /**
     * Set item_height
     * @param float $value
     * @return $this
     */
    public function setItemHeight($value);

    /**
     * get item_height
     * @return float
     */
    public function getItemHeight();

    /**
     * Set item_top_diameter
     * @param float $value
     * @return $this
     */
    public function setItemTopDiameter($value);

    /**
     * get item_top_diameter
     * @return float
     */
    public function getItemTopDiameter();

    /**
     * Set item_bottom_diameter
     * @param float $value
     * @return $this
     */
    public function setItemBottomDiameter($value);

    /**
     * get item_bottom_diameter
     * @return float
     */
    public function getItemBottomDiameter();

    /**
     * Set item_length
     * @param float $value
     * @return $this
     */
    public function setItemLength($value);

    /**
     * get item_length
     * @return float
     */
    public function getItemLength();

    /**
     * Set item_diameter
     * @param float $value
     * @return $this
     */
    public function setItemDiameter($value);

    /**
     * get item_diameter
     * @return float
     */
    public function getItemDiameter();

    /**
     * Set fits_car_cup_holder
     * @param boolean $value
     * @return $this
     */
    public function setFitsCarCupHolder($value);

    /**
     * get fits_car_cup_holder
     * @return boolean
     */
    public function getFitsCarCupHolder();

    /**
     * Set microwave_safe
     * @param boolean $value
     * @return $this
     */
    public function setMicrowaveSafe($value);

    /**
     * get microwave_safe
     * @return boolean
     */
    public function getMicrowaveSafe();

    /**
     * Set top_rack_dishwasher_safe
     * @param boolean $value
     * @return $this
     */
    public function setTopRackDishwasherSafe($value);

    /**
     * get top_rack_dishwasher_safe
     * @return boolean
     */
    public function getTopRackDishwasherSafe();

    /**
     * Set carabiner_included
     * @param boolean $value
     * @return $this
     */
    public function setCarabinerIncluded($value);

    /**
     * get carabiner_included
     * @return boolean
     */
    public function getCarabinerIncluded();

    /**
     * Set spill_proof
     * @param boolean $value
     * @return $this
     */
    public function setSpillProof($value);

    /**
     * get spill_proof
     * @return boolean
     */
    public function getSpillProof();

    /**
     * Set spill_persistant
     * @param boolean $value
     * @return $this
     */
    public function setSpillPersistant($value);

    /**
     * get spill_persistant
     * @return boolean
     */
    public function getSpillPersistant();

    /**
     * Set handwash_only
     * @param boolean $value
     * @return $this
     */
    public function setHandwashOnly($value);

    /**
     * get handwash_only
     * @return boolean
     */
    public function getHandwashOnly();

    /**
     * Set patent_number
     * @param string $value
     * @return $this
     */
    public function setPatentNumber($value);

    /**
     * get patent_number
     * @return string
     */
    public function getPatentNumber();

    /**
     * Set recycle_number
     * @param string $value
     * @return $this
     */
    public function setRecycleNumber($value);

    /**
     * get recycle_number
     * @return string
     */
    public function getRecycleNumber();

    /**
     * Set mah
     * @param string $value
     * @return $this
     */
    public function setMAH($value);

    /**
     * get mah
     * @return string
     */
    public function getMAH();

    /**
     * Set batteries_included
     * @param boolean $value
     * @return $this
     */
    public function setBatteriesIncluded($value);

    /**
     * get batteries_included
     * @return boolean
     */
    public function getBatteriesIncluded();

    /**
     * @return \Items\ItemInformation\Api\Data\ItemDetailsExtensionInterface|null
     */
    public function getExtensionAttributes();
 
    /**
     * @param \Items\ItemInformation\Api\Data\ItemDetailsExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\ItemDetailsExtensionInterface $extensionAttributes);

}