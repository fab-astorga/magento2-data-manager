<?php
namespace Items\ItemInformation\Model;

Class ItemMainShots extends \Magento\Framework\Model\AbstractExtensibleModel implements \Items\ItemInformation\Api\Data\ItemMainShotsInterface 
{
    
    protected function _construct()
    {
        $this->_init('Items\ItemInformation\Model\ResourceModel\ItemMainShots');
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
     * Set item_group_shot
     * @param string $value
     * @return $this
     */
    public function setItemGroupShot($value){
        return $this->setData(self::ITEM_GROUP_SHOT, $value);
    }

    /**
     * get item_group_shot
     * @return string
     */
    public function getItemGroupShot(){
        return $this->getData(self::ITEM_GROUP_SHOT);
    }

    /**
     * Set item_glamour_shot
     * @param string $value
     * @return $this
     */
    public function setItemGlamourShot($value){
        return $this->setData(self::ITEM_GLAMOUR_SHOT, $value);
    }

    /**
     * get item_glamour_shot
     * @return string
     */
    public function getItemGlamourShot(){
        return $this->getData(self::ITEM_GLAMOUR_SHOT);
    }

    /**
     * Set glamour_shot_alt_1
     * @param string $value
     * @return $this
     */
    public function setGlamourShotAlt1($value){
        return $this->setData(self::GLAMOUR_SHOT_ALT_1, $value);
    }

    /**
     * get glamour_shot_alt_1
     * @return string
     */
    public function getGlamourShotAlt1(){
        return $this->getData(self::GLAMOUR_SHOT_ALT_1);
    }

    /**
     * Set group_shot_alt_1
     * @param string $value
     * @return $this
     */
    public function setGroupShotAlt1($value){
        return $this->setData(self::GROUP_SHOT_ALT_1, $value);
    }

    /**
     * get group_shot_alt_1
     * @return string
     */
    public function getGroupShotAlt1(){
        return $this->getData(self::GROUP_SHOT_ALT_1);
    }

    /**
     * Set group_shot_alt_2
     * @param string $value
     * @return $this
     */
    public function setGroupShotAlt2($value){
        return $this->setData(self::GROUP_SHOT_ALT_2, $value);
    }

    /**
     * get group_shot_alt_2
     * @return string
     */
    public function getGroupShotAlt2(){
        return $this->getData(self::GROUP_SHOT_ALT_2);
    }

    /**
     * Set lid_1_shot
     * @param string $value
     * @return $this
     */
    public function setLid1shot($value){
        return $this->setData(self::LID_1_SHOT, $value);
    }

    /**
     * get lid_1_shot
     * @return string
     */
    public function getLid1shot(){
        return $this->getData(self::LID_1_SHOT);
    }

    /**
     * Set lid_2_shot
     * @param string $value
     * @return $this
     */
    public function setLid2shot($value){
        return $this->setData(self::LID_2_SHOT, $value);
    }

    /**
     * get lid_2_shot
     * @return string
     */
    public function getLid2shot(){
        return $this->getData(self::LID_2_SHOT);
    }

    /**
     * Set gift_box_alt_1
     * @param string $value
     * @return $this
     */
    public function setGiftBoxAlt1($value){
        return $this->setData(self::GIFT_BOX_ALT_1, $value);
    }

    /**
     * get gift_box_alt_1
     * @return string
     */
    public function getGiftBoxAlt1(){
        return $this->getData(self::GIFT_BOX_ALT_1);
    }

    /**
     * Set gift_box_alt_2
     * @param string $value
     * @return $this
     */
    public function setGiftBoxAlt2($value){
        return $this->setData(self::GIFT_BOX_ALT_2, $value);
    }

    /**
     * get gift_box_alt_2
     * @return string
     */
    public function getGiftBoxAlt2(){
        return $this->getData(self::GIFT_BOX_ALT_2);
    }

    /**
     * @return \Items\ItemInformation\Api\Data\ItemMainShotsExtensionInterface|null
     */
    public function getExtensionAttributes(){

    }
 
    /**
     * @param \Items\ItemInformation\Api\Data\ItemMainShotsExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\ItemMainShotsExtensionInterface $extensionAttributes){

    }

}