<?php
namespace Items\ItemInformation\Model;

Class SafetyDetails extends \Magento\Framework\Model\AbstractExtensibleModel implements \Items\ItemInformation\Api\Data\SafetyDetailsInterface 
{
    
    protected function _construct()
    {
        $this->_init('Items\ItemInformation\Model\ResourceModel\SafetyDetails');
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
     * Set safety_details_name
     * @param string $value
     * @return $this
     */
    public function setSafetyDetailsName($value){
        return $this->setData(self::SAFETY_DETAILS_NAME, $value);
    }

    /**
     * get safety_details_name
     * @return string
     */
    public function getSafetyDetailsName(){
        return $this->getData(self::SAFETY_DETAILS_NAME);
    }

    /**
     * Set safety_details_link
     * @param string $value
     * @return $this
     */
    public function setSafetyDetailsLink($value){
        return $this->setData(self::SAFETY_DETAILS_LINK, $value);
    }

    /**
     * get safety_details_link
     * @return string
     */
    public function getSafetyDetailsLink(){
        return $this->getData(self::SAFETY_DETAILS_LINK);
    }

    /**
     * Set safety_details_name_2
     * @param string $value
     * @return $this
     */
    public function setSafetyDetailsNameTwo($value){
        return $this->setData(self::SAFETY_DETAILS_NAME_2, $value);
    }

    /**
     * get safety_details_name_2
     * @return string
     */
    public function getSafetyDetailsNameTwo(){
        return $this->getData(self::SAFETY_DETAILS_NAME_2);
    }

    /**
     * Set safety_details_link_2
     * @param string $value
     * @return $this
     */
    public function setSafetyDetailsLinkTwo($value){
        return $this->setData(self::SAFETY_DETAILS_LINK_2, $value);
    }

    /**
     * get safety_details_link_2
     * @return string
     */
    public function getSafetyDetailsLinkTwo(){
        return $this->getData(self::SAFETY_DETAILS_LINK_2);
    }

    /**
     * Set safety_details_name_3
     * @param string $value
     * @return $this
     */
    public function setSafetyDetailsNameThree($value){
        return $this->setData(self::SAFETY_DETAILS_NAME_3, $value);
    }

    /**
     * get safety_details_name_3
     * @return string
     */
    public function getSafetyDetailsNameThree(){
        return $this->getData(self::SAFETY_DETAILS_NAME_3);
    }

    /**
     * Set safety_details_link_3
     * @param string $value
     * @return $this
     */
    public function setSafetyDetailsLinkThree($value){
        return $this->setData(self::SAFETY_DETAILS_LINK_3, $value);
    }

    /**
     * get safety_details_link_3
     * @return string
     */
    public function getSafetyDetailsLinkThree(){
        return $this->getData(self::SAFETY_DETAILS_LINK_3);
    }

    /**
     * Set safety_test_link
     * @param string $value
     * @return $this
     */
    public function setSafetyTestLink($value){
        return $this->setData(self::SAFETY_TEST_LINK, $value);
    }

    /**
     * get safety_test_link
     * @return string
     */
    public function getSafetyTestLink(){
        return $this->getData(self::SAFETY_TEST_LINK);
    }

    /**
     * Set fda_test_link
     * @param string $value
     * @return $this
     */
    public function setFdaTestLink($value){
        return $this->setData(self::FDA_TEST_LINK, $value);
    }

    /**
     * get fda_test_link
     * @return string
     */
    public function getFdaTestLink(){
        return $this->getData(self::FDA_TEST_LINK);
    }

    /**
     * Set safety_test_date
     * @param string $value
     * @return $this
     */
    public function setSafetyTestDate($value){
        return $this->setData(self::SAFETY_TEST_DATE, $value);
    }

    /**
     * get safety_test_date
     * @return string
     */
    public function getSafetyTestDate(){
        return $this->getData(self::SAFETY_TEST_DATE);
    }

    /**
     * Set prop65_warning
     * @param boolean $value
     * @return $this
     */
    public function setProp65Warning($value){
        return $this->setData(self::PROP65_WARNING, $value);
    }

    /**
     * get prop65_warning
     * @return boolean
     */
    public function getProp65Warning(){
        return $this->getData(self::PROP65_WARNING);
    }

    /**
     * Set safety_test_available
     * @param boolean $value
     * @return $this
     */
    public function setSafetyTestAvailable($value){
        return $this->setData(self::SAFETY_TEST_AVAILABLE, $value);
    }

    /**
     * get safety_test_available
     * @return boolean
     */
    public function getSafetyTestAvailable(){
        return $this->getData(self::SAFETY_TEST_AVAILABLE);
    }

    /**
     * @return \Items\ItemInformation\Api\Data\SafetyDetailsExtensionInterface|null
     */
    public function getExtensionAttributes(){

    }
 
    /**
     * @param \Items\ItemInformation\Api\Data\SafetyDetailsExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\SafetyDetailsExtensionInterface $extensionAttributes){

    }

}