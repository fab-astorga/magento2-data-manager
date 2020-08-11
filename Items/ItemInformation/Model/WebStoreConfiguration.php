<?php
namespace Items\ItemInformation\Model;

Class WebStoreConfiguration extends \Magento\Framework\Model\AbstractExtensibleModel implements \Items\ItemInformation\Api\Data\WebStoreConfigurationInterface 
{
    
    protected function _construct()
    {
        $this->_init('Items\ItemInformation\Model\ResourceModel\WebStoreConfiguration');
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
     * Set page_title
     * @param string $value
     * @return $this
     */
    public function setPageTitle($value){
        return $this->setData(self::PAGE_TITLE, $value);
    }

    /**
     * get page_title
     * @return string
     */
    public function getPageTitle(){
        return $this->getData(self::PAGE_TITLE);
    }

    /**
     * Set item_number_for_webstore
     * @param string $value
     * @return $this
     */
    public function setItemNumberForWebstore($value){
        return $this->setData(self::ITEM_NUMBER_FOR_WEBSTORE, $value);
    }

    /**
     * get item_number_for_webstore
     * @return string
     */
    public function getItemNumberForWebstore(){
        return $this->getData(self::ITEM_NUMBER_FOR_WEBSTORE);
    }

    /**
     * Set summary_store_description
     * @param string $value
     * @return $this
     */
    public function setSummaryStoreDescription($value){
        return $this->setData(self::SUMMARY_STORE_DESCRIPTION, $value);
    }

    /**
     * get summary_store_description
     * @return string
     */
    public function getSummaryStoreDescription(){
        return $this->getData(self::SUMMARY_STORE_DESCRIPTION);
    }

    /**
     * Set detailed_description
     * @param string $value
     * @return $this
     */
    public function setDetailedDescription($value){
        return $this->setData(self::DETAILED_DESCRIPTION, $value);
    }

    /**
     * get detailed_description
     * @return string
     */
    public function getDetailedDescription(){
        return $this->getData(self::DETAILED_DESCRIPTION);
    }

    /**
     * Set summary_description_for_imprint_methods
     * @param string $value
     * @return $this
     */
    public function setSummaryDescriptionForImprintMethods($value){
        return $this->setData(self::SUMMARY_DESCRIPTION_FOR_IMPRINT_METHODS, $value);
    }

    /**
     * get summary_description_for_imprint_methods
     * @return string
     */
    public function getSummaryDescriptionForImprintMethods(){
        return $this->getData(self::SUMMARY_DESCRIPTION_FOR_IMPRINT_METHODS);
    }

    /**
     * Set create_virtual_link
     * @param string $value
     * @return $this
     */
    public function setCreateVirtualLink($value){
        return $this->setData(self::CREATE_VIRTUAL_LINK, $value);
    }

    /**
     * get create_virtual_link
     * @return string
     */
    public function getCreateVirtualLink(){
        return $this->getData(self::CREATE_VIRTUAL_LINK);
    }

    /**
     * Set create_flyer
     * @param string $value
     * @return $this
     */
    public function setCreateFlyer($value){
        return $this->setData(self::CREATE_FLYER, $value);
    }

    /**
     * get create_flyer
     * @return string
     */
    public function getCreateFlyer(){
        return $this->getData(self::CREATE_FLYER);
    }

    /**
     * Set parent_summary_store_description
     * @param string $value
     * @return $this
     */
    public function setParentSummaryStoreDescription($value){
        return $this->setData(self::PARENT_SUMMARY_STORE_DESCRIPTION, $value);
    }

    /**
     * get parent_summary_store_description
     * @return string
     */
    public function getParentSummaryStoreDescription(){
        return $this->getData(self::PARENT_SUMMARY_STORE_DESCRIPTION);
    }

    /**
     * Set out_of_stock_behavior
     * @param string $value
     * @return $this
     */
    public function setOutOfStockBehavior($value){
        return $this->setData(self::OUT_OF_STOCK_BEHAVIOR, $value);
    }

    /**
     * get out_of_stock_behavior
     * @return string
     */
    public function getOutOfStockBehavior(){
        return $this->getData(self::OUT_OF_STOCK_BEHAVIOR);
    }

    /**
     * Set out_of_stock_message
     * @param string $value
     * @return $this
     */
    public function setOutOfStockMessage($value){
        return $this->setData(self::OUT_OF_STOCK_MESSAGE, $value);
    }

    /**
     * get out_of_stock_message
     * @return string
     */
    public function getOutOfStockMessage(){
        return $this->getData(self::OUT_OF_STOCK_MESSAGE);
    }

    /**
     * Set no_price_message
     * @param string $value
     * @return $this
     */
    public function setNoPriceMessage($value){
        return $this->setData(self::NO_PRICE_MESSAGE, $value);
    }

    /**
     * get no_price_message
     * @return string
     */
    public function getNoPriceMessage(){
        return $this->getData(self::NO_PRICE_MESSAGE);
    }

    /**
     * Set select_color_for_pricing
     * @param string $value
     * @return $this
     */
    public function setSelectColorForPricing($value){
        return $this->setData(self::SELECT_COLOR_FOR_PRICING, $value);
    }

    /**
     * get select_color_for_pricing
     * @return string
     */
    public function getSelectColorForPricing(){
        return $this->getData(self::SELECT_COLOR_FOR_PRICING);
    }

    /**
     * Set coupon_code
     * @param string $value
     * @return $this
     */
    public function setCouponCode($value){
        return $this->setData(self::COUPON_CODE, $value);
    }

    /**
     * get coupon_code
     * @return string
     */
    public function getCouponCode(){
        return $this->getData(self::COUPON_CODE);
    }

    /**
     * Set color_disclaimer
     * @param string $value
     * @return $this
     */
    public function setColorDisclaimer($value){
        return $this->setData(self::COLOR_DISCLAIMER, $value);
    }

    /**
     * get color_disclaimer
     * @return string
     */
    public function getColorDisclaimer(){
        return $this->getData(self::COLOR_DISCLAIMER);
    }

    /**
     * Set price_includes
     * @param string $value
     * @return $this
     */
    public function setPriceIncludes($value){
        return $this->setData(self::PRICE_INCLUDES, $value);
    }

    /**
     * get price_includes
     * @return string
     */
    public function getPriceIncludes(){
        return $this->getData(self::PRICE_INCLUDES);
    }

    /**
     * Set item_notes_for_web
     * @param string $value
     * @return $this
     */
    public function setItemNotesForWeb($value){
        return $this->setData(self::ITEM_NOTES_FOR_WEB, $value);
    }

    /**
     * get item_notes_for_web
     * @return string
     */
    public function getItemNotesForWeb(){
        return $this->getData(self::ITEM_NOTES_FOR_WEB);
    }

    /**
     * Set esp_item_keywords
     * @param string $value
     * @return $this
     */
    public function setEspItemKeywords($value){
        return $this->setData(self::ESP_ITEM_KEYWORDS, $value);
    }

    /**
     * get esp_item_keywords
     * @return string
     */
    public function getEspItemKeywords(){
        return $this->getData(self::ESP_ITEM_KEYWORDS);
    }

    /**
     * Set video_link
     * @param string $value
     * @return $this
     */
    public function setVideoLink($value){
        return $this->setData(self::VIDEO_LINK, $value);
    }

    /**
     * get video_link
     * @return string
     */
    public function getVideoLink(){
        return $this->getData(self::VIDEO_LINK);
    }

    /**
     * Set video_name
     * @param string $value
     * @return $this
     */
    public function setVideoName($value){
        return $this->setData(self::VIDEO_NAME, $value);
    }

    /**
     * get video_name
     * @return string
     */
    public function getVideoName(){
        return $this->getData(self::VIDEO_NAME);
    }

    /**
     * Set maximum_variable_amount
     * @param float $value
     * @return $this
     */
    public function setMaximumVariableAmount($value){
        return $this->setData(self::MAXIMUM_VARIABLE_AMOUNT, $value);
    }

    /**
     * get maximum_variable_amount
     * @return float
     */
    public function getMaximumVariableAmount(){
        return $this->getData(self::MAXIMUM_VARIABLE_AMOUNT);
    }

    /**
     * Set display_in_webstore
     * @param boolean $value
     * @return $this
     */
    public function setDisplayInWebstore($value){
        return $this->setData(self::DISPLAY_IN_WEBSTORE, $value);
    }

    /**
     * get display_in_webstore
     * @return boolean
     */
    public function getDisplayInWebstore(){
        return $this->getData(self::DISPLAY_IN_WEBSTORE);
    }

    /**
     * Set override_web_inventory
     * @param boolean $value
     * @return $this
     */
    public function setOverrideWebInventory($value){
        return $this->setData(self::OVERRIDE_WEB_INVENTORY, $value);
    }

    /**
     * get override_web_inventory
     * @return boolean
     */
    public function getOverrideWebInventory(){
        return $this->getData(self::OVERRIDE_WEB_INVENTORY);
    }

    /**
     * Set variable_amount
     * @param boolean $value
     * @return $this
     */
    public function setVariableAmount($value){
        return $this->setData(self::VARIABLE_AMOUNT, $value);
    }

    /**
     * get variable_amount
     * @return boolean
     */
    public function getVariableAmount(){
        return $this->getData(self::VARIABLE_AMOUNT);
    }

    /**
     * Set show_default_amount
     * @param boolean $value
     * @return $this
     */
    public function setShowDefaultAmount($value){
        return $this->setData(self::SHOW_DEFAULT_AMOUNT, $value);
    }

    /**
     * get show_default_amount
     * @return boolean
     */
    public function getShowDefaultAmount(){
        return $this->getData(self::SHOW_DEFAULT_AMOUNT);
    }

    /**
     * Set do_not_show_price
     * @param boolean $value
     * @return $this
     */
    public function setDoNotShowPrice($value){
        return $this->setData(self::DO_NOT_SHOW_PRICE, $value);
    }

    /**
     * get do_not_show_price
     * @return boolean
     */
    public function getDoNotShowPrice(){
        return $this->getData(self::DO_NOT_SHOW_PRICE);
    }

    /**
     * Set always_available
     * @param boolean $value
     * @return $this
     */
    public function setAlwaysAvailable($value){
        return $this->setData(self::ALWAYS_AVAILABLE, $value);
    }

    /**
     * get always_available
     * @return boolean
     */
    public function getAlwaysAvailable(){
        return $this->getData(self::ALWAYS_AVAILABLE);
    }

    /**
     * @return \Items\ItemInformation\Api\Data\WebStoreConfigurationExtensionInterface|null
     */
    public function getExtensionAttributes(){

    }
 
    /**
     * @param \Items\ItemInformation\Api\Data\WebStoreConfigurationExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\WebStoreConfigurationExtensionInterface $extensionAttributes){

    }

}