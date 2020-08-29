<?php
namespace Items\ItemInformation\Model;

Class ShippingDetails extends \Magento\Framework\Model\AbstractExtensibleModel implements \Items\ItemInformation\Api\Data\ShippingDetailsInterface 
{
    
    protected function _construct()
    {
        $this->_init('Items\ItemInformation\Model\ResourceModel\ShippingDetails');
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
     * Set schedule_b_number
     * @param string $value
     * @return $this
     */
    public function setScheduleBNumber($value){
        return $this->setData(self::SCHEDULE_B_NUMBER, $value);
    }

    /**
     * get schedule_b_number
     * @return string
     */
    public function getScheduleBNumber(){
        return $this->getData(self::SCHEDULE_B_NUMBER);
    }

    /**
     * Set individual_item_weight_oz
     * @param float $value
     * @return $this
     */
    public function setIndividualItemWeightOz($value){
        return $this->setData(self::INDIVIDUAL_ITEM_WEIGHT_OZ, $value);
    }

    /**
     * get individual_item_weight_oz
     * @return float
     */
    public function getIndividualItemWeightOz(){
        return $this->getData(self::INDIVIDUAL_ITEM_WEIGHT_OZ);
    }

    /**
     * Set gift_box_weight_oz
     * @param float $value
     * @return $this
     */
    public function setGiftBoxWeightOz($value){
        return $this->setData(self::GIFT_BOX_WEIGHT_OZ, $value);
    }

    /**
     * get gift_box_weight_oz
     * @return float
     */
    public function getGiftBoxWeightOz(){
        return $this->getData(self::GIFT_BOX_WEIGHT_OZ);
    }

    /**
     * Set total_item_weight
     * @param float $value
     * @return $this
     */
    public function setTotalItemWeight($value){
        return $this->setData(self::TOTAL_ITEM_WEIGHT, $value);
    }

    /**
     * get total_item_weight
     * @return float
     */
    public function getTotalItemWeight(){
        return $this->getData(self::TOTAL_ITEM_WEIGHT);
    }

    /**
     * Set total_item_weight_unit
     * @param string $value
     * @return $this
     */
    public function setTotalItemWeightUnit($value){
        return $this->setData(self::TOTAL_ITEM_WEIGHT_UNIT, $value);
    }

    /**
     * get total_item_weight_unit
     * @return string
     */
    public function getTotalItemWeightUnit(){
        return $this->getData(self::TOTAL_ITEM_WEIGHT_UNIT);
    }

    /**
     * Set items_per_carton
     * @param int $value
     * @return $this
     */
    public function setItemsPerCarton($value){
        return $this->setData(self::ITEMS_PER_CARTON, $value);
    }

    /**
     * get items_per_carton
     * @return int
     */
    public function getItemsPerCarton(){
        return $this->getData(self::ITEMS_PER_CARTON);
    }

    /**
     * Set gift_box_color
     * @param string $value
     * @return $this
     */
    public function setGiftBoxColor($value){
        return $this->setData(self::GIFT_BOX_COLOR, $value);
    }

    /**
     * get gift_box_color
     * @return string
     */
    public function getGiftBoxColor(){
        return $this->getData(self::GIFT_BOX_COLOR);
    }

    /**
     * Set package
     * @param string $value
     * @return $this
     */
    public function setPackage($value){
        return $this->setData(self::PACKAGE, $value);
    }

    /**
     * get package
     * @return string
     */
    public function getPackage(){
        return $this->getData(self::PACKAGE);
    }

    /**
     * Set carton_size
     * @param string $value
     * @return $this
     */
    public function setCartonSize($value){
        return $this->setData(self::CARTON_SIZE, $value);
    }

    /**
     * get carton_size
     * @return string
     */
    public function getCartonSize(){
        return $this->getData(self::CARTON_SIZE);
    }

    /**
     * Set additional_shipping_costs
     * @param string $value
     * @return $this
     */
    public function setAdditionalShippingCosts($value){
        return $this->setData(self::ADDITIONAL_SHIPPING_COSTS, $value);
    }

    /**
     * get additional_shipping_costs
     * @return string
     */
    public function getAdditionalShippingCosts(){
        return $this->getData(self::ADDITIONAL_SHIPPING_COSTS);
    }

    /**
     * Set carton_weight_oz
     * @param float $value
     * @return $this
     */
    public function setCartonWeightOz($value){
        return $this->setData(self::CARTON_WEIGHT_OZ, $value);
    }

    /**
     * get carton_weight_oz
     * @return float
     */
    public function getCartonWeightOz(){
        return $this->getData(self::CARTON_WEIGHT_OZ);
    }

    /**
     * Set total_carton_weight_lbs
     * @param float $value
     * @return $this
     */
    public function setTotalCartonWeightLbs($value){
        return $this->setData(self::TOTAL_CARTON_WEIGHT_LBS, $value);
    }

    /**
     * get total_carton_weight_lbs
     * @return float
     */
    public function getTotalCartonWeightLbs(){
        return $this->getData(self::TOTAL_CARTON_WEIGHT_LBS);
    }

    /**
     * Set shipping_data_verified
     * @param bool $value
     * @return $this
     */
    public function setShippingDataVerified($value){
        return $this->setData(self::SHIPPING_DATA_VERIFIED, $value);
    }

    /**
     * get shipping_data_verified
     * @return bool
     */
    public function getShippingDataVerified(){
        return $this->getData(self::SHIPPING_DATA_VERIFIED);
    }

    /**
     * Set total_cartons_per_pallet
     * @param int $value
     * @return $this
     */
    public function setTotalCartonsPerPallet($value){
        return $this->setData(self::TOTAL_CARTON_PER_PALLET, $value);
    }

    /**
     * get total_cartons_per_pallet
     * @return int
     */
    public function getTotalCartonsPerPallet(){
        return $this->getData(self::TOTAL_CARTON_PER_PALLET);
    }

    /**
     * Set pack_out_quantity
     * @param int $value
     * @return $this
     */
    public function setPackOutQuantity($value){
        return $this->setData(self::PACK_OUT_QUANTITY, $value);
    }

    /**
     * get pack_out_quantity
     * @return int
     */
    public function getPackOutQuantity(){
        return $this->getData(self::PACK_OUT_QUANTITY);
    }

    /**
     * Set ice_pack_required
     * @param boolean $value
     * @return $this
     */
    public function setIcePackRequired($value){
        return $this->setData(self::ICE_PACK_REQUIRED, $value);
    }

    /**
     * get ice_pack_required
     * @return boolean
     */
    public function getIcePackRequired(){
        return $this->getData(self::ICE_PACK_REQUIRED);
    }

    /**
     * @return \Items\ItemInformation\Api\Data\ShippingDetailsExtensionInterface|null
     */
    public function getExtensionAttributes(){

    }
 
    /**
     * @param \Items\ItemInformation\Api\Data\ShippingDetailsExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\ShippingDetailsExtensionInterface $extensionAttributes){
    }
}