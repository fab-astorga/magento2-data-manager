<?php
namespace Items\ItemInformation\Model;

Class ItemMatrixShots extends \Magento\Framework\Model\AbstractExtensibleModel implements \Items\ItemInformation\Api\Data\ItemMatrixShotsInterface 
{
    
    protected function _construct()
    {
        $this->_init('Items\ItemInformation\Model\ResourceModel\ItemMatrixShots');
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
     * Set web_Store_color_order
     * @param int $value
     * @return $this
     */
    public function setWebStoreColorOrder($value){
        return $this->setData(self::WEB_STORE_COLOR_ORDER, $value);
    }

    /**
     * get web_Store_color_order
     * @return int
     */
    public function getWebStoreColorOrder(){
        return $this->getData(self::WEB_STORE_COLOR_ORDER);
    }

    /**
     * Set matrix_image
     * @param string $value
     * @return $this
     */
    public function setMatrixImage($value){
        return $this->setData(self::MATRIX_IMAGE, $value);
    }

    /**
     * get matrix_image
     * @return string
     */
    public function getMatrixImage(){
        return $this->getData(self::MATRIX_IMAGE);
    }

    /**
     * Set alternate_image_1
     * @param string $value
     * @return $this
     */
    public function setAlternateImage1($value){
        return $this->setData(self::ALTERNATE_IMAGE_1, $value);
    }

    /**
     * get alternate_image_1
     * @return string
     */
    public function getAlternateImage1(){
        return $this->getData(self::ALTERNATE_IMAGE_1);
    }

    /**
     * Set alternate_image_2
     * @param string $value
     * @return $this
     */
    public function setAlternateImage2($value){
        return $this->setData(self::ALTERNATE_IMAGE_2, $value);
    }

    /**
     * get alternate_image_2
     * @return string
     */
    public function getAlternateImage2(){
        return $this->getData(self::ALTERNATE_IMAGE_2);
    }

    /**
     * Set alternate_image_3
     * @param string $value
     * @return $this
     */
    public function setAlternateImage3($value){
        return $this->setData(self::ALTERNATE_IMAGE_3, $value);
    }

    /**
     * get alternate_image_3
     * @return string
     */
    public function getAlternateImage3(){
        return $this->getData(self::ALTERNATE_IMAGE_3);
    }

    /**
     * Set alternate_image_4
     * @param string $value
     * @return $this
     */
    public function setAlternateImage4($value){
        return $this->setData(self::ALTERNATE_IMAGE_4, $value);
    }

    /**
     * get alternate_image_4
     * @return string
     */
    public function getAlternateImage4(){
        return $this->getData(self::ALTERNATE_IMAGE_4);
    }

    /**
     * Set blank_image_high_res
     * @param string $value
     * @return $this
     */
    public function setBlankImageHighRes($value){
        return $this->setData(self::BLANK_IMAGE_HIGH_RES, $value);
    }

    /**
     * get blank_image_high_res
     * @return string
     */
    public function getBlankImageHighRes(){
        return $this->getData(self::BLANK_IMAGE_HIGH_RES);
    }

    /**
     * Set logo_image_high_res
     * @param string $value
     * @return $this
     */
    public function setLogoImageHighRes($value){
        return $this->setData(self::LOGO_IMAGE_HIGH_RES, $value);
    }

    /**
     * get logo_image_high_res
     * @return string
     */
    public function getLogoImageHighRes(){
        return $this->getData(self::LOGO_IMAGE_HIGH_RES);
    }

    /**
     * Set new_color_added
     * @param bool $value
     * @return $this
     */
    public function setNewColorAdded($value){
        return $this->setData(self::NEW_COLOR_ADDED, $value);
    }

    /**
     * get new_color_added
     * @return bool
     */
    public function getNewColorAdded(){
        return $this->getData(self::NEW_COLOR_ADDED);
    }

    /**
     * Set matrix_item_option_color
     * @param string $value
     * @return $this
     */
    public function setMatrixItemOptionColor($value){
        return $this->setData(self::MATRIX_ITEM_OPTION_COLOR, $value);
    }

    /**
     * get matrix_item_option_color
     * @return string
     */
    public function getMatrixItemOptionColor(){
        return $this->getData(self::MATRIX_ITEM_OPTION_COLOR);
    }

    /**
     * @return \Items\ItemInformation\Api\Data\ItemMatrixShotsExtensionInterface|null
     */
    public function getExtensionAttributes(){

    }
 
    /**
     * @param \Items\ItemInformation\Api\Data\ItemMatrixShotsExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\ItemMatrixShotsExtensionInterface $extensionAttributes){

    }

}