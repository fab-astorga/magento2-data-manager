<?php
namespace Items\ItemInformation\Model;

Class AdditionalDownloads extends \Magento\Framework\Model\AbstractExtensibleModel implements \Items\ItemInformation\Api\Data\AdditionalDownloadsInterface 
{
    
    protected function _construct()
    {
        $this->_init('Items\ItemInformation\Model\ResourceModel\AdditionalDownloads');
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
     * Set tt_downloads_documents_link_1
     * @param string $value
     * @return $this
     */
    public function setDownloadsDocumentsLink1($value){
        return $this->setData(self::DOWNLOADS_DOCUMENTS_LINK_1, $value);
    }

    /**
     * get tt_downloads_documents_link_1
     * @return string
     */
    public function getDownloadsDocumentsLink1(){
        return $this->getData(self::DOWNLOADS_DOCUMENTS_LINK_1);
    }

    /**
     * Set tt_downloads_documents_link_2
     * @param string $value
     * @return $this
     */
    public function setDownloadsDocumentsLink2($value){
        return $this->setData(self::DOWNLOADS_DOCUMENTS_LINK_2, $value);
    }

    /**
     * get tt_downloads_documents_link_2
     * @return string
     */
    public function getDownloadsDocumentsLink2(){
        return $this->getData(self::DOWNLOADS_DOCUMENTS_LINK_2);
    }

    /**
     * Set tt_downloads_documents_link_3
     * @param string $value
     * @return $this
     */
    public function setDownloadsDocumentsLink3($value){
        return $this->setData(self::DOWNLOADS_DOCUMENTS_LINK_3, $value);
    }

    /**
     * get tt_downloads_documents_link_3
     * @return string
     */
    public function getDownloadsDocumentsLink3(){
        return $this->getData(self::DOWNLOADS_DOCUMENTS_LINK_3);
    }


    /**
     * Set tt_downloads_documents_name_1
     * @param string $value
     * @return $this
     */
    public function setDownloadsDocumentsName1($value){
        return $this->setData(self::DOWNLOADS_DOCUMENTS_NAME_1, $value);
    }

    /**
     * get tt_downloads_documents_name_1
     * @return string
     */
    public function getDownloadsDocumentsName1(){
        return $this->getData(self::DOWNLOADS_DOCUMENTS_NAME_1);
    }

    /**
     * Set tt_downloads_documents_name_2
     * @param string $value
     * @return $this
     */
    public function setDownloadsDocumentsName2($value){
        return $this->setData(self::DOWNLOADS_DOCUMENTS_NAME_2, $value);
    }

    /**
     * get tt_downloads_documents_name_2
     * @return string
     */
    public function getDownloadsDocumentsName2(){
        return $this->getData(self::DOWNLOADS_DOCUMENTS_NAME_2);
    }

    /**
     * Set tt_downloads_documents_name_3
     * @param string $value
     * @return $this
     */
    public function setDownloadsDocumentsName3($value){
        return $this->setData(self::DOWNLOADS_DOCUMENTS_NAME_3, $value);
    }

    /**
     * get tt_downloads_documents_name_3
     * @return string
     */
    public function getDownloadsDocumentsName3(){
        return $this->getData(self::DOWNLOADS_DOCUMENTS_NAME_3);
    }

    /**
     * Set tt_download_image_1
     * @param string $value
     * @return $this
     */
    public function setDownloadImage1($value){
        return $this->setData(self::DOWNLOAD_IMAGE_1, $value);
    }

    /**
     * get tt_download_image_1
     * @return string
     */
    public function getDownloadImage1(){
        return $this->getData(self::DOWNLOAD_IMAGE_1);
    }

    /**
     * Set tt_download_image_2
     * @param string $value
     * @return $this
     */
    public function setDownloadImage2($value){
        return $this->setData(self::DOWNLOAD_IMAGE_2, $value);
    }

    /**
     * get tt_download_image_2
     * @return string
     */
    public function getDownloadImage2(){
        return $this->getData(self::DOWNLOAD_IMAGE_2);
    }

    /**
     * Set tt_download_image_3
     * @param string $value
     * @return $this
     */
    public function setDownloadImage3($value){
        return $this->setData(self::DOWNLOAD_IMAGE_3, $value);
    }

    /**
     * get tt_download_image_3
     * @return string
     */
    public function getDownloadImage3(){
        return $this->getData(self::DOWNLOAD_IMAGE_3);
    }

    /**
     * Set tt_download_image_4
     * @param string $value
     * @return $this
     */
    public function setDownloadImage4($value){
        return $this->setData(self::DOWNLOAD_IMAGE_4, $value);
    }

    /**
     * get tt_download_image_4
     * @return string
     */
    public function getDownloadImage4(){
        return $this->getData(self::DOWNLOAD_IMAGE_4);
    }

    /**
     * Set tt_download_image_5
     * @param string $value
     * @return $this
     */
    public function setDownloadImage5($value){
        return $this->setData(self::DOWNLOAD_IMAGE_5, $value);
    }

    /**
     * get tt_download_image_5
     * @return string
     */
    public function getDownloadImage5(){
        return $this->getData(self::DOWNLOAD_IMAGE_5);
    }

    /**
     * Set tt_download_image_6
     * @param string $value
     * @return $this
     */
    public function setDownloadImage6($value){
        return $this->setData(self::DOWNLOAD_IMAGE_6, $value);
    }

    /**
     * get tt_download_image_6
     * @return string
     */
    public function getDownloadImage6(){
        return $this->getData(self::DOWNLOAD_IMAGE_6);
    }

    /**
     * Set tt_download_image_7
     * @param string $value
     * @return $this
     */
    public function setDownloadImage7($value){
        return $this->setData(self::DOWNLOAD_IMAGE_7, $value);
    }

    /**
     * get tt_download_image_7
     * @return string
     */
    public function getDownloadImage7(){
        return $this->getData(self::DOWNLOAD_IMAGE_7);
    }

    /**
     * Set tt_download_image_8
     * @param string $value
     * @return $this
     */
    public function setDownloadImage8($value){
        return $this->setData(self::DOWNLOAD_IMAGE_8, $value);
    }

    /**
     * get tt_download_image_8
     * @return string
     */
    public function getDownloadImage8(){
        return $this->getData(self::DOWNLOAD_IMAGE_8);
    }

    /**
     * Set tt_download_image_name_1
     * @param string $value
     * @return $this
     */
    public function setDownloadImageName1($value){
        return $this->setData(self::DOWNLOAD_IMAGE_NAME_1, $value);
    }

    /**
     * get tt_download_image_name_1
     * @return string
     */
    public function getDownloadImageName1(){
        return $this->getData(self::DOWNLOAD_IMAGE_NAME_1);
    }

    /**
     * Set tt_download_image_name_2
     * @param string $value
     * @return $this
     */
    public function setDownloadImageName2($value){
        return $this->setData(self::DOWNLOAD_IMAGE_NAME_2, $value);
    }

    /**
     * get tt_download_image_name_2
     * @return string
     */
    public function getDownloadImageName2(){
        return $this->getData(self::DOWNLOAD_IMAGE_NAME_2);
    }

    /**
     * Set tt_download_image_name_3
     * @param string $value
     * @return $this
     */
    public function setDownloadImageName3($value){
        return $this->setData(self::DOWNLOAD_IMAGE_NAME_3, $value);
    }

    /**
     * get tt_download_image_name_3
     * @return string
     */
    public function getDownloadImageName3(){
        return $this->getData(self::DOWNLOAD_IMAGE_NAME_3);
    }

    /**
     * Set tt_download_image_name_4
     * @param string $value
     * @return $this
     */
    public function setDownloadImageName4($value){
        return $this->setData(self::DOWNLOAD_IMAGE_NAME_4, $value);
    }

    /**
     * get tt_download_image_name_4
     * @return string
     */
    public function getDownloadImageName4(){
        return $this->getData(self::DOWNLOAD_IMAGE_NAME_4);
    }

    /**
     * Set tt_download_image_name_5
     * @param string $value
     * @return $this
     */
    public function setDownloadImageName5($value){
        return $this->setData(self::DOWNLOAD_IMAGE_NAME_5, $value);
    }

    /**
     * get tt_download_image_name_5
     * @return string
     */
    public function getDownloadImageName5(){
        return $this->getData(self::DOWNLOAD_IMAGE_NAME_5);
    }

    /**
     * Set tt_download_image_name_6
     * @param string $value
     * @return $this
     */
    public function setDownloadImageName6($value){
        return $this->setData(self::DOWNLOAD_IMAGE_NAME_6, $value);
    }

    /**
     * get tt_download_image_name_6
     * @return string
     */
    public function getDownloadImageName6(){
        return $this->getData(self::DOWNLOAD_IMAGE_NAME_6);
    }

    /**
     * Set tt_download_image_name_7
     * @param string $value
     * @return $this
     */
    public function setDownloadImageName7($value){
        return $this->setData(self::DOWNLOAD_IMAGE_NAME_7, $value);
    }

    /**
     * get tt_download_image_name_7
     * @return string
     */
    public function getDownloadImageName7(){
        return $this->getData(self::DOWNLOAD_IMAGE_NAME_7);
    }

    /**
     * Set tt_download_image_name_8
     * @param string $value
     * @return $this
     */
    public function setDownloadImageName8($value){
        return $this->setData(self::DOWNLOAD_IMAGE_NAME_8, $value);
    }

    /**
     * get tt_download_image_name_8
     * @return string
     */
    public function getDownloadImageName8(){
        return $this->getData(self::DOWNLOAD_IMAGE_NAME_8);
    }


    /**
     * @return \Items\ItemInformation\Api\Data\AdditionalDownloadsExtensionInterface|null
     */
    public function getExtensionAttributes(){

    }
 
    /**
     * @param \Items\ItemInformation\Api\Data\AdditionalDownloadsExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\AdditionalDownloadsExtensionInterface $extensionAttributes){

    }

}