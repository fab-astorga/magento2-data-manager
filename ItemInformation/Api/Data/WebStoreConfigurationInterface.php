<?php
namespace Items\ItemInformation\Api\Data;

Interface WebStoreConfigurationInterface extends \Magento\Framework\Api\ExtensibleDataInterface {
    
    /**#@+
     * Constants defined for keys of  data array
     */
    const ITEM_ID = 'item_id';

    const PAGE_TITLE = 'page_title';

    const ITEM_NUMBER_FOR_WEBSTORE = 'item_number_for_webstore';

    const SUMMARY_STORE_DESCRIPTION = 'summary_store_description';

    const DETAILED_DESCRIPTION = 'detailed_description';

    const SUMMARY_DESCRIPTION_FOR_IMPRINT_METHODS = 'summary_description_for_imprint_methods';

    const CREATE_VIRTUAL_LINK = 'create_virtual_link';

    const CREATE_FLYER = 'create_flyer';

    const PARENT_SUMMARY_STORE_DESCRIPTION = 'parent_summary_store_description';

    const OUT_OF_STOCK_BEHAVIOR = 'out_of_stock_behavior';

    const OUT_OF_STOCK_MESSAGE = 'out_of_stock_message';

    const NO_PRICE_MESSAGE = 'no_price_message';

    const SELECT_COLOR_FOR_PRICING = 'select_color_for_pricing';

    const COUPON_CODE = 'coupon_code';

    const COLOR_DISCLAIMER = 'color_disclaimer';

    const PRICE_INCLUDES = 'price_includes';

    const ITEM_NOTES_FOR_WEB = 'item_notes_for_web';

    const ESP_ITEM_KEYWORDS = 'esp_item_keywords';

    const VIDEO_LINK = 'video_link';

    const VIDEO_NAME = 'video_name';

    const MAXIMUM_VARIABLE_AMOUNT = 'maximum_variable_amount';

    const DISPLAY_IN_WEBSTORE = 'display_in_webstore';

    const OVERRIDE_WEB_INVENTORY = 'override_web_inventory';

    const VARIABLE_AMOUNT = 'variable_amount';

    const SHOW_DEFAULT_AMOUNT = 'show_default_amount';

    const DO_NOT_SHOW_PRICE = 'do_not_show_price';

    const ALWAYS_AVAILABLE = 'always_available';


    const ATTRIBUTES = [
        self::ITEM_ID,
        self::PAGE_TITLE,
        self::ITEM_NUMBER_FOR_WEBSTORE,
        self::SUMMARY_STORE_DESCRIPTION,
        self::DETAILED_DESCRIPTION,
        self::SUMMARY_DESCRIPTION_FOR_IMPRINT_METHODS,
        self::CREATE_VIRTUAL_LINK,
        self::CREATE_FLYER,
        self::PARENT_SUMMARY_STORE_DESCRIPTION,
        self::OUT_OF_STOCK_BEHAVIOR,
        self::OUT_OF_STOCK_MESSAGE,
        self::NO_PRICE_MESSAGE,
        self::SELECT_COLOR_FOR_PRICING,
        self::COUPON_CODE,
        self::COLOR_DISCLAIMER,
        self::PRICE_INCLUDES,
        self::ITEM_NOTES_FOR_WEB,
        self::ESP_ITEM_KEYWORDS,
        self::VIDEO_LINK,
        self::VIDEO_NAME,
        self::MAXIMUM_VARIABLE_AMOUNT,
        self::DISPLAY_IN_WEBSTORE,
        self::OVERRIDE_WEB_INVENTORY,
        self::VARIABLE_AMOUNT,
        self::SHOW_DEFAULT_AMOUNT,
        self::DO_NOT_SHOW_PRICE,
        self::ALWAYS_AVAILABLE
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
     * Set page_title
     * @param string $value
     * @return $this
     */
    public function setPageTitle($value);

    /**
     * get page_title
     * @return string
     */
    public function getPageTitle();

    /**
     * Set item_number_for_webstore
     * @param string $value
     * @return $this
     */
    public function setItemNumberForWebstore($value);

    /**
     * get item_number_for_webstore
     * @return string
     */
    public function getItemNumberForWebstore();

    /**
     * Set summary_store_description
     * @param string $value
     * @return $this
     */
    public function setSummaryStoreDescription($value);

    /**
     * get summary_store_description
     * @return string
     */
    public function getSummaryStoreDescription();

    /**
     * Set detailed_description
     * @param string $value
     * @return $this
     */
    public function setDetailedDescription($value);

    /**
     * get detailed_description
     * @return string
     */
    public function getDetailedDescription();

    /**
     * Set summary_description_for_imprint_methods
     * @param string $value
     * @return $this
     */
    public function setSummaryDescriptionForImprintMethods($value);

    /**
     * get summary_description_for_imprint_methods
     * @return string
     */
    public function getSummaryDescriptionForImprintMethods();

    /**
     * Set create_virtual_link
     * @param string $value
     * @return $this
     */
    public function setCreateVirtualLink($value);

    /**
     * get create_virtual_link
     * @return string
     */
    public function getCreateVirtualLink();

    /**
     * Set create_flyer
     * @param string $value
     * @return $this
     */
    public function setCreateFlyer($value);

    /**
     * get create_flyer
     * @return string
     */
    public function getCreateFlyer();

    /**
     * Set parent_summary_store_description
     * @param string $value
     * @return $this
     */
    public function setParentSummaryStoreDescription($value);

    /**
     * get parent_summary_store_description
     * @return string
     */
    public function getParentSummaryStoreDescription();

    /**
     * Set out_of_stock_behavior
     * @param string $value
     * @return $this
     */
    public function setOutOfStockBehavior($value);

    /**
     * get out_of_stock_behavior
     * @return string
     */
    public function getOutOfStockBehavior();

    /**
     * Set out_of_stock_message
     * @param string $value
     * @return $this
     */
    public function setOutOfStockMessage($value);

    /**
     * get out_of_stock_message
     * @return string
     */
    public function getOutOfStockMessage();

    /**
     * Set no_price_message
     * @param string $value
     * @return $this
     */
    public function setNoPriceMessage($value);

    /**
     * get no_price_message
     * @return string
     */
    public function getNoPriceMessage();

    /**
     * Set select_color_for_pricing
     * @param string $value
     * @return $this
     */
    public function setSelectColorForPricing($value);

    /**
     * get select_color_for_pricing
     * @return string
     */
    public function getSelectColorForPricing();

    /**
     * Set coupon_code
     * @param string $value
     * @return $this
     */
    public function setCouponCode($value);

    /**
     * get coupon_code
     * @return string
     */
    public function getCouponCode();

    /**
     * Set color_disclaimer
     * @param string $value
     * @return $this
     */
    public function setColorDisclaimer($value);

    /**
     * get color_disclaimer
     * @return string
     */
    public function getColorDisclaimer();

    /**
     * Set price_includes
     * @param string $value
     * @return $this
     */
    public function setPriceIncludes($value);

    /**
     * get price_includes
     * @return string
     */
    public function getPriceIncludes();

    /**
     * Set item_notes_for_web
     * @param string $value
     * @return $this
     */
    public function setItemNotesForWeb($value);

    /**
     * get item_notes_for_web
     * @return string
     */
    public function getItemNotesForWeb();


    /**
     * Set esp_item_keywords
     * @param string $value
     * @return $this
     */
    public function setEspItemKeywords($value);

    /**
     * get esp_item_keywords
     * @return string
     */
    public function getEspItemKeywords();

    /**
     * Set video_link
     * @param string $value
     * @return $this
     */
    public function setVideoLink($value);

    /**
     * get video_link
     * @return string
     */
    public function getVideoLink();

    /**
     * Set video_name
     * @param string $value
     * @return $this
     */
    public function setVideoName($value);

    /**
     * get video_name
     * @return string
     */
    public function getVideoName();

    /**
     * Set maximum_variable_amount
     * @param float $value
     * @return $this
     */
    public function setMaximumVariableAmount($value);

    /**
     * get maximum_variable_amount
     * @return float
     */
    public function getMaximumVariableAmount();

    /**
     * Set display_in_webstore
     * @param boolean $value
     * @return $this
     */
    public function setDisplayInWebstore($value);

    /**
     * get display_in_webstore
     * @return boolean
     */
    public function getDisplayInWebstore();

    /**
     * Set override_web_inventory
     * @param boolean $value
     * @return $this
     */
    public function setOverrideWebInventory($value);

    /**
     * get override_web_inventory
     * @return boolean
     */
    public function getOverrideWebInventory();

    /**
     * Set variable_amount
     * @param boolean $value
     * @return $this
     */
    public function setVariableAmount($value);

    /**
     * get variable_amount
     * @return boolean
     */
    public function getVariableAmount();

    /**
     * Set show_default_amount
     * @param boolean $value
     * @return $this
     */
    public function setShowDefaultAmount($value);

    /**
     * get show_default_amount
     * @return boolean
     */
    public function getShowDefaultAmount();

    /**
     * Set do_not_show_price
     * @param boolean $value
     * @return $this
     */
    public function setDoNotShowPrice($value);

    /**
     * get do_not_show_price
     * @return boolean
     */
    public function getDoNotShowPrice();

    /**
     * Set always_available
     * @param boolean $value
     * @return $this
     */
    public function setAlwaysAvailable($value);

    /**
     * get always_available
     * @return boolean
     */
    public function getAlwaysAvailable();

    /**
     * @return \Items\ItemInformation\Api\Data\WebStoreConfigurationExtensionInterface|null
     */
    public function getExtensionAttributes();
 
    /**
     * @param \Items\ItemInformation\Api\Data\WebStoreConfigurationExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\WebStoreConfigurationExtensionInterface $extensionAttributes);

}