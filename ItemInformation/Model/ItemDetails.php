<?php
namespace Items\ItemInformation\Model;

Class ItemDetails extends \Magento\Framework\Model\AbstractExtensibleModel implements \Items\ItemInformation\Api\Data\ItemDetailsInterface 
{
    
    protected function _construct()
    {
        $this->_init('Items\ItemInformation\Model\ResourceModel\ItemDetails');
    }

    /**
     * Set item_id
     * @param int $value
     * @return $this
     */
    public function setItemId($value){
        return $this->setData(self::ITEM_ID, $value);
    }

    /**
     * get item_id
     * @return int
     */
    public function getItemId(){
        return $this->getData(self::ITEM_ID);
    }

    /**
     * Set sales_description
     * @param string $value
     * @return $this
     */
    public function setSalesDescription($value){
        return $this->setData(self::SALES_DESCRIPTION, $value);
    }

    /**
     * get sales_description
     * @return string
     */
    public function getSalesDescription(){
        return $this->getData(self::SALES_DESCRIPTION);
    }

    /**
     * Set item_pms_color
     * @param string $value
     * @return $this
     */
    public function setItemPMSColor($value){
        return $this->setData(self::ITEM_PMS_COLOR, $value);
    }

    /**
     * get item_pms_color
     * @return string
     */
    public function getItemPMSColor(){
        return $this->getData(self::ITEM_PMS_COLOR);
    }

    /**
     * Set item_volume_in_oz
     * @param float $value
     * @return $this
     */
    public function setItemVolumeInOz($value){
        return $this->setData(self::ITEM_VOLUME_IN_OZ, $value);
    }

    /**
     * get item_volume_in_oz
     * @return float
     */
    public function getItemVolumeInOz(){
        return $this->getData(self::ITEM_VOLUME_IN_OZ);
    }

    /**
     * Set item_packaging
     * @param string $value
     * @return $this
     */
    public function setItemPackaging($value){
        return $this->setData(self::ITEM_PACKAGING, $value);
    }

    /**
     * get item_packaging
     * @return string
     */
    public function getPackaging(){
        return $this->getData(self::ITEM_PACKAGING);
    }

    /**
     * Set item_material
     * @param string $value
     * @return $this
     */
    public function setItemMaterial($value){
        return $this->setData(self::ITEM_MATERIAL, $value);
    }

    /**
     * get item_material
     * @return string
     */
    public function getItemMaterial(){
        return $this->getData(self::ITEM_MATERIAL);
    }

    /**
     * Set item_gusset
     * @param int $value
     * @return $this
     */
    public function setItemGusset($value){
        return $this->setData(self::ITEM_GUSSET, $value);
    }

    /**
     * get item_gusset
     * @return int
     */
    public function getItemGusset(){
        return $this->getData(self::ITEM_GUSSET);
    }

    /**
     * Set item_handle_length
     * @param int $value
     * @return $this
     */
    public function setItemHandleLength($value){
        return $this->setData(self::ITEM_HANDLE_LENGTH, $value);
    }

    /**
     * get item_handle_length
     * @return int
     */
    public function getItemHandleLength(){
        return $this->getData(self::ITEM_HANDLE_LENGTH);
    }

    /**
     * Set item_depth
     * @param float $value
     * @return $this
     */
    public function setItemDepth($value){
        return $this->setData(self::ITEM_DEPTH, $value);
    }

    /**
     * get item_depth
     * @return float
     */
    public function getItemDepth(){
        return $this->getData(self::ITEM_DEPTH);
    }

    /**
     * Set item_width
     * @param float $value
     * @return $this
     */
    public function setItemWidth($value){
        return $this->setData(self::ITEM_WIDTH, $value);
    }

    /**
     * get item_width
     * @return float
     */
    public function getItemWidth(){
        return $this->getData(self::ITEM_WIDTH);
    }

    /**
     * Set item_height
     * @param float $value
     * @return $this
     */
    public function setItemHeight($value){
        return $this->setData(self::ITEM_HEIGHT, $value);
    }

    /**
     * get item_height
     * @return float
     */
    public function getItemHeight(){
        return $this->getData(self::ITEM_HEIGHT);
    }

    /**
     * Set item_top_diameter
     * @param float $value
     * @return $this
     */
    public function setItemTopDiameter($value){
        return $this->setData(self::ITEM_TOP_DIAMETER, $value);
    }

    /**
     * get item_top_diameter
     * @return float
     */
    public function getItemTopDiameter(){
        return $this->getData(self::ITEM_TOP_DIAMETER);
    }

    /**
     * Set item_bottom_diameter
     * @param float $value
     * @return $this
     */
    public function setItemBottomDiameter($value){
        return $this->setData(self::ITEM_BOTTOM_DIAMETER, $value);
    }

    /**
     * get item_bottom_diameter
     * @return float
     */
    public function getItemBottomDiameter(){
        return $this->getData(self::ITEM_BOTTOM_DIAMETER);
    }

    /**
     * Set item_length
     * @param float $value
     * @return $this
     */
    public function setItemLength($value){
        return $this->setData(self::ITEM_LENGTH, $value);
    }

    /**
     * get item_length
     * @return float
     */
    public function getItemLength(){
        return $this->getData(self::ITEM_LENGTH);
    }

    /**
     * Set item_diameter
     * @param float $value
     * @return $this
     */
    public function setItemDiameter($value){
        return $this->setData(self::ITEM_DIAMETER, $value);
    }

    /**
     * get item_diameter
     * @return float
     */
    public function getItemDiameter(){
        return $this->getData(self::ITEM_DIAMETER);
    }

    /**
     * Set fits_car_cup_holder
     * @param boolean $value
     * @return $this
     */
    public function setFitsCarCupHolder($value){
        return $this->setData(self::FITS_CAR_CUP_HOLDER, $value);
    }

    /**
     * get fits_car_cup_holder
     * @return boolean
     */
    public function getFitsCarCupHolder(){
        return $this->getData(self::FITS_CAR_CUP_HOLDER);
    }

    /**
     * Set microwave_safe
     * @param boolean $value
     * @return $this
     */
    public function setMicrowaveSafe($value){
        return $this->setData(self::MICROWAVE_SAFE, $value);
    }

    /**
     * get microwave_safe
     * @return boolean
     */
    public function getMicrowaveSafe(){
        return $this->getData(self::MICROWAVE_SAFE);
    }

    /**
     * Set top_rack_dishwasher_safe
     * @param boolean $value
     * @return $this
     */
    public function setTopRackDishwasherSafe($value){
        return $this->setData(self::TOP_RACK_DISHWASHER_SAFE, $value);
    }

    /**
     * get top_rack_dishwasher_safe
     * @return boolean
     */
    public function getTopRackDishwasherSafe(){
        return $this->getData(self::TOP_RACK_DISHWASHER_SAFE);
    }

    /**
     * Set carabiner_included
     * @param boolean $value
     * @return $this
     */
    public function setCarabinerIncluded($value){
        return $this->setData(self::CARABINER_INCLUDED, $value);
    }

    /**
     * get carabiner_included
     * @return boolean
     */
    public function getCarabinerIncluded(){
        return $this->getData(self::CARABINER_INCLUDED);
    }

    /**
     * Set spill_proof
     * @param boolean $value
     * @return $this
     */
    public function setSpillProof($value){
        return $this->setData(self::SPILL_PROOF, $value);
    }

    /**
     * get spill_proof
     * @return boolean
     */
    public function getSpillProof(){
        return $this->getData(self::SPILL_PROOF);
    }

    /**
     * Set spill_persistant
     * @param boolean $value
     * @return $this
     */
    public function setSpillPersistant($value){
        return $this->setData(self::SPILL_PRESISTANT, $value);
    }

    /**
     * get spill_persistant
     * @return boolean
     */
    public function getSpillPersistant(){
        return $this->getData(self::SPILL_PRESISTANT);
    }

    /**
     * Set handwash_only
     * @param boolean $value
     * @return $this
     */
    public function setHandwashOnly($value){
        return $this->setData(self::HANDWASH_ONLY, $value);
    }

    /**
     * get handwash_only
     * @return boolean
     */
    public function getHandwashOnly(){
        return $this->getData(self::HANDWASH_ONLY);
    }

        /**
     * Set patent_number
     * @param string $value
     * @return $this
     */
    public function setPatentNumber($value){
        return $this->setData(self::PATENT_NUMBER, $value);
    }

    /**
     * get patent_number
     * @return string
     */
    public function getPatentNumber(){
        return $this->getData(self::PATENT_NUMBER);
    }

    /**
     * Set recycle_number
     * @param string $value
     * @return $this
     */
    public function setRecycleNumber($value){
        return $this->setData(self::RECYCLE_NUMBER, $value);
    }

    /**
     * get recycle_number
     * @return string
     */
    public function getRecycleNumber(){
        return $this->getData(self::RECYCLE_NUMBER);
    }

    /**
     * Set mah
     * @param string $value
     * @return $this
     */
    public function setMAH($value){
        return $this->setData(self::MAH, $value);
    }

    /**
     * get mah
     * @return string
     */
    public function getMAH(){
        return $this->getData(self::MAH);
    }

    /**
     * Set batteries_included
     * @param boolean $value
     * @return $this
     */
    public function setBatteriesIncluded($value){
        return $this->setData(self::BATTERIES_INCLUDED, $value);
    }

    /**
     * get batteries_included
     * @return boolean
     */
    public function getBatteriesIncluded(){
        return $this->getData(self::BATTERIES_INCLUDED);
    }

    /**
     * @return \Items\ItemInformation\Api\Data\ItemDetailsExtensionInterface|null
     */
    public function getExtensionAttributes(){

    }
 
    /**
     * @param \Items\ItemInformation\Api\Data\ItemDetailsExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\ItemDetailsExtensionInterface $extensionAttributes){

    }

}