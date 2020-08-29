<?php
namespace Items\ItemInformation\Api\Data;

Interface ItemMatrixShotsInterface extends \Magento\Framework\Api\ExtensibleDataInterface {
    
    /**#@+
     * Constants defined for keys of  data array
     */
    const ITEM_ID = 'item_id';

    const WEB_STORE_COLOR_ORDER = 'web_Store_color_order';

    const MATRIX_IMAGE = 'matrix_image';

    const ALTERNATE_IMAGE_1 = 'alternate_image_1';

    const ALTERNATE_IMAGE_2 = 'alternate_image_2';

    const ALTERNATE_IMAGE_3 = 'alternate_image_3';

    const ALTERNATE_IMAGE_4 = 'alternate_image_4';

    const BLANK_IMAGE_HIGH_RES = 'blank_image_high_res';

    const LOGO_IMAGE_HIGH_RES = 'logo_image_high_res';

    const NEW_COLOR_ADDED = 'new_color_added';

    const MATRIX_ITEM_OPTION_COLOR = 'matrix_item_option_color';

    const ATTRIBUTES = [
        self::ITEM_ID,
        self::WEB_STORE_COLOR_ORDER,
        self::MATRIX_IMAGE,
        self::ALTERNATE_IMAGE_1,
        self::ALTERNATE_IMAGE_2,
        self::ALTERNATE_IMAGE_3,
        self::ALTERNATE_IMAGE_4,
        self::BLANK_IMAGE_HIGH_RES,
        self::LOGO_IMAGE_HIGH_RES,
        self::NEW_COLOR_ADDED,
        self::MATRIX_ITEM_OPTION_COLOR
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
     * Set web_Store_color_order
     * @param int $value
     * @return $this
     */
    public function setWebStoreColorOrder($value);

    /**
     * get web_Store_color_order
     * @return int
     */
    public function getWebStoreColorOrder();

    /**
     * Set matrix_image
     * @param string $value
     * @return $this
     */
    public function setMatrixImage($value);

    /**
     * get matrix_image
     * @return string
     */
    public function getMatrixImage();

    /**
     * Set alternate_image_1
     * @param string $value
     * @return $this
     */
    public function setAlternateImage1($value);

    /**
     * get alternate_image_1
     * @return string
     */
    public function getAlternateImage1();

    /**
     * Set alternate_image_2
     * @param string $value
     * @return $this
     */
    public function setAlternateImage2($value);

    /**
     * get alternate_image_2
     * @return string
     */
    public function getAlternateImage2();

    /**
     * Set alternate_image_3
     * @param string $value
     * @return $this
     */
    public function setAlternateImage3($value);

    /**
     * get alternate_image_3
     * @return string
     */
    public function getAlternateImage3();

    /**
     * Set alternate_image_4
     * @param string $value
     * @return $this
     */
    public function setAlternateImage4($value);

    /**
     * get alternate_image_4
     * @return string
     */
    public function getAlternateImage4();

    /**
     * Set blank_image_high_res
     * @param string $value
     * @return $this
     */
    public function setBlankImageHighRes($value);

    /**
     * get blank_image_high_res
     * @return string
     */
    public function getBlankImageHighRes();

    /**
     * Set logo_image_high_res
     * @param string $value
     * @return $this
     */
    public function setLogoImageHighRes($value);

    /**
     * get logo_image_high_res
     * @return string
     */
    public function getLogoImageHighRes();

    /**
     * Set new_color_added
     * @param bool $value
     * @return $this
     */
    public function setNewColorAdded($value);

    /**
     * get new_color_added
     * @return bool
     */
    public function getNewColorAdded();

    /**
     * Set matrix_item_option_color
     * @param string $value
     * @return $this
     */
    public function setMatrixItemOptionColor($value);

    /**
     * get matrix_item_option_color
     * @return string
     */
    public function getMatrixItemOptionColor();


    /**
     * @return \Items\ItemInformation\Api\Data\ItemMatrixShotsExtensionInterface|null
     */
    public function getExtensionAttributes();
 
    /**
     * @param \Items\ItemInformation\Api\Data\ItemMatrixShotsExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\ItemMatrixShotsExtensionInterface $extensionAttributes);

}