<?php
namespace Items\ItemInformation\Api\Data;

Interface AdditionalDownloadsInterface extends \Magento\Framework\Api\ExtensibleDataInterface {
    
    /**#@+
     * Constants defined for keys of  data array
     */

    const ITEM_ID = 'item_id';

    const DOWNLOADS_DOCUMENTS_LINK_1 = 'tt_downloads_documents_link_1';

    const DOWNLOADS_DOCUMENTS_LINK_2 = 'tt_downloads_documents_link_2';

    const DOWNLOADS_DOCUMENTS_LINK_3 = 'tt_downloads_documents_link_3';

    const DOWNLOADS_DOCUMENTS_NAME_1 = 'tt_downloads_documents_name_1';

    const DOWNLOADS_DOCUMENTS_NAME_2 = 'tt_downloads_documents_name_2';

    const DOWNLOADS_DOCUMENTS_NAME_3 = 'tt_downloads_documents_name_3';

    const DOWNLOAD_IMAGE_1 = 'tt_download_image_1';

    const DOWNLOAD_IMAGE_2 = 'tt_download_image_2';

    const DOWNLOAD_IMAGE_3 = 'tt_download_image_3';

    const DOWNLOAD_IMAGE_4 = 'tt_download_image_4';

    const DOWNLOAD_IMAGE_5 = 'tt_download_image_5';

    const DOWNLOAD_IMAGE_6 = 'tt_download_image_6';

    const DOWNLOAD_IMAGE_7 = 'tt_download_image_7';

    const DOWNLOAD_IMAGE_8 = 'tt_download_image_8';

    const DOWNLOAD_IMAGE_NAME_1 = 'tt_download_image_name_1';

    const DOWNLOAD_IMAGE_NAME_2 = 'tt_download_image_name_2';

    const DOWNLOAD_IMAGE_NAME_3 = 'tt_download_image_name_3';

    const DOWNLOAD_IMAGE_NAME_4 = 'tt_download_image_name_4';

    const DOWNLOAD_IMAGE_NAME_5 = 'tt_download_image_name_5';

    const DOWNLOAD_IMAGE_NAME_6 = 'tt_download_image_name_6';

    const DOWNLOAD_IMAGE_NAME_7 = 'tt_download_image_name_7';

    const DOWNLOAD_IMAGE_NAME_8 = 'tt_download_image_name_8';

    const ATTRIBUTES = [
        self::ITEM_ID,
        self::DOWNLOADS_DOCUMENTS_LINK_1,
        self::DOWNLOADS_DOCUMENTS_LINK_2,
        self::DOWNLOADS_DOCUMENTS_LINK_3,
        self::DOWNLOADS_DOCUMENTS_NAME_1,
        self::DOWNLOADS_DOCUMENTS_NAME_2,
        self::DOWNLOADS_DOCUMENTS_NAME_3,
        self::DOWNLOAD_IMAGE_1,
        self::DOWNLOAD_IMAGE_2,
        self::DOWNLOAD_IMAGE_3,
        self::DOWNLOAD_IMAGE_4,
        self::DOWNLOAD_IMAGE_5,
        self::DOWNLOAD_IMAGE_6,
        self::DOWNLOAD_IMAGE_7,
        self::DOWNLOAD_IMAGE_8,
        self::DOWNLOAD_IMAGE_NAME_1,
        self::DOWNLOAD_IMAGE_NAME_2,
        self::DOWNLOAD_IMAGE_NAME_3,
        self::DOWNLOAD_IMAGE_NAME_4,
        self::DOWNLOAD_IMAGE_NAME_5,
        self::DOWNLOAD_IMAGE_NAME_6,
        self::DOWNLOAD_IMAGE_NAME_7,
        self::DOWNLOAD_IMAGE_NAME_8
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
     * Set tt_downloads_documents_link_1
     * @param string $value
     * @return $this
     */
    public function setDownloadsDocumentsLink1($value);

    /**
     * get tt_downloads_documents_link_1
     * @return string
     */
    public function getDownloadsDocumentsLink1();

    /**
     * Set tt_downloads_documents_link_2
     * @param string $value
     * @return $this
     */
    public function setDownloadsDocumentsLink2($value);

    /**
     * get tt_downloads_documents_link_2
     * @return string
     */
    public function getDownloadsDocumentsLink2();

    /**
     * Set tt_downloads_documents_link_3
     * @param string $value
     * @return $this
     */
    public function setDownloadsDocumentsLink3($value);

    /**
     * get tt_downloads_documents_link_3
     * @return string
     */
    public function getDownloadsDocumentsLink3();


    /**
     * Set tt_downloads_documents_name_1
     * @param string $value
     * @return $this
     */
    public function setDownloadsDocumentsName1($value);

    /**
     * get tt_downloads_documents_name_1
     * @return string
     */
    public function getDownloadsDocumentsName1();

    /**
     * Set tt_downloads_documents_name_2
     * @param string $value
     * @return $this
     */
    public function setDownloadsDocumentsName2($value);

    /**
     * get tt_downloads_documents_name_2
     * @return string
     */
    public function getDownloadsDocumentsName2();

    /**
     * Set tt_downloads_documents_name_3
     * @param string $value
     * @return $this
     */
    public function setDownloadsDocumentsName3($value);

    /**
     * get tt_downloads_documents_name_3
     * @return string
     */
    public function getDownloadsDocumentsName3();

    /**
     * Set tt_download_image_1
     * @param string $value
     * @return $this
     */
    public function setDownloadImage1($value);

    /**
     * get tt_download_image_1
     * @return string
     */
    public function getDownloadImage1();

    /**
     * Set tt_download_image_2
     * @param string $value
     * @return $this
     */
    public function setDownloadImage2($value);

    /**
     * get tt_download_image_2
     * @return string
     */
    public function getDownloadImage2();

    /**
     * Set tt_download_image_3
     * @param string $value
     * @return $this
     */
    public function setDownloadImage3($value);

    /**
     * get tt_download_image_3
     * @return string
     */
    public function getDownloadImage3();

    /**
     * Set tt_download_image_4
     * @param string $value
     * @return $this
     */
    public function setDownloadImage4($value);

    /**
     * get tt_download_image_4
     * @return string
     */
    public function getDownloadImage4();

    /**
     * Set tt_download_image_5
     * @param string $value
     * @return $this
     */
    public function setDownloadImage5($value);

    /**
     * get tt_download_image_5
     * @return string
     */
    public function getDownloadImage5();

    /**
     * Set tt_download_image_6
     * @param string $value
     * @return $this
     */
    public function setDownloadImage6($value);

    /**
     * get tt_download_image_6
     * @return string
     */
    public function getDownloadImage6();

    /**
     * Set tt_download_image_7
     * @param string $value
     * @return $this
     */
    public function setDownloadImage7($value);

    /**
     * get tt_download_image_7
     * @return string
     */
    public function getDownloadImage7();

    /**
     * Set tt_download_image_8
     * @param string $value
     * @return $this
     */
    public function setDownloadImage8($value);

    /**
     * get tt_download_image_8
     * @return string
     */
    public function getDownloadImage8();

    /**
     * Set tt_download_image_name_1
     * @param string $value
     * @return $this
     */
    public function setDownloadImageName1($value);

    /**
     * get tt_download_image_name_1
     * @return string
     */
    public function getDownloadImageName1();

    /**
     * Set tt_download_image_name_2
     * @param string $value
     * @return $this
     */
    public function setDownloadImageName2($value);

    /**
     * get tt_download_image_name_2
     * @return string
     */
    public function getDownloadImageName2();

    /**
     * Set tt_download_image_name_3
     * @param string $value
     * @return $this
     */
    public function setDownloadImageName3($value);

    /**
     * get tt_download_image_name_3
     * @return string
     */
    public function getDownloadImageName3();

    /**
     * Set tt_download_image_name_4
     * @param string $value
     * @return $this
     */
    public function setDownloadImageName4($value);

    /**
     * get tt_download_image_name_4
     * @return string
     */
    public function getDownloadImageName4();

    /**
     * Set tt_download_image_name_5
     * @param string $value
     * @return $this
     */
    public function setDownloadImageName5($value);

    /**
     * get tt_download_image_name_5
     * @return string
     */
    public function getDownloadImageName5();

    /**
     * Set tt_download_image_name_6
     * @param string $value
     * @return $this
     */
    public function setDownloadImageName6($value);

    /**
     * get tt_download_image_name_6
     * @return string
     */
    public function getDownloadImageName6();

    /**
     * Set tt_download_image_name_7
     * @param string $value
     * @return $this
     */
    public function setDownloadImageName7($value);

    /**
     * get tt_download_image_name_7
     * @return string
     */
    public function getDownloadImageName7();

    /**
     * Set tt_download_image_name_8
     * @param string $value
     * @return $this
     */
    public function setDownloadImageName8($value);

    /**
     * get tt_download_image_name_8
     * @return string
     */
    public function getDownloadImageName8();

    /**
     * @return \Items\ItemInformation\Api\Data\AdditionalDownloadsExtensionInterface|null
     */
    public function getExtensionAttributes();
 
    /**
     * @param \Items\ItemInformation\Api\Data\AdditionalDownloadsExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\AdditionalDownloadsExtensionInterface $extensionAttributes);

}