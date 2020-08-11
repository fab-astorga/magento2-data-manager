<?php
namespace Items\ItemInformation\Api\Data;

Interface SafetyDetailsInterface extends \Magento\Framework\Api\ExtensibleDataInterface {
    
    /**#@+
     * Constants defined for keys of  data array
     */
    const ITEM_ID = 'item_id';

    const SAFETY_DETAILS_NAME = 'safety_details_name';

    const SAFETY_DETAILS_LINK = 'safety_details_link';

    const SAFETY_DETAILS_NAME_2 = 'safety_details_name_2';

    const SAFETY_DETAILS_LINK_2 = 'safety_details_link_2';

    const SAFETY_DETAILS_NAME_3 = 'safety_details_name_3';

    const SAFETY_DETAILS_LINK_3 = 'safety_details_link_3';

    const SAFETY_TEST_LINK = 'safety_test_link';

    const FDA_TEST_LINK = 'fda_test_link';

    const SAFETY_TEST_DATE = 'safety_test_date';

    const PROP65_WARNING = 'prop65_warning';

    const SAFETY_TEST_AVAILABLE = 'safety_test_available';

    const ATTRIBUTES = [
        self::ITEM_ID,
        self::SAFETY_DETAILS_NAME,
        self::SAFETY_DETAILS_LINK,
        self::SAFETY_DETAILS_NAME_2,
        self::SAFETY_DETAILS_LINK_2,
        self::SAFETY_DETAILS_NAME_3,
        self::SAFETY_DETAILS_LINK_3,
        self::SAFETY_TEST_LINK,
        self::FDA_TEST_LINK,
        self::SAFETY_TEST_DATE,
        self::PROP65_WARNING,
        self::SAFETY_TEST_AVAILABLE
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
     * Set safety_details_name
     * @param string $value
     * @return $this
     */
    public function setSafetyDetailsName($value);

    /**
     * get safety_details_name
     * @return string
     */
    public function getSafetyDetailsName();

    /**
     * Set safety_details_link
     * @param string $value
     * @return $this
     */
    public function setSafetyDetailsLink($value);

    /**
     * get safety_details_link
     * @return string
     */
    public function getSafetyDetailsLink();

    /**
     * Set safety_details_name_2
     * @param string $value
     * @return $this
     */
    public function setSafetyDetailsNameTwo($value);

    /**
     * get safety_details_name_2
     * @return string
     */
    public function getSafetyDetailsNameTwo();

    /**
     * Set safety_details_link_2
     * @param string $value
     * @return $this
     */
    public function setSafetyDetailsLinkTwo($value);

    /**
     * get safety_details_link_2
     * @return string
     */
    public function getSafetyDetailsLinkTwo();

    /**
     * Set safety_details_name_3
     * @param string $value
     * @return $this
     */
    public function setSafetyDetailsNameThree($value);

    /**
     * get safety_details_name_3
     * @return string
     */
    public function getSafetyDetailsNameThree();

    /**
     * Set safety_details_link_3
     * @param string $value
     * @return $this
     */
    public function setSafetyDetailsLinkThree($value);

    /**
     * get safety_details_link_3
     * @return string
     */
    public function getSafetyDetailsLinkThree();

    /**
     * Set safety_test_link
     * @param string $value
     * @return $this
     */
    public function setSafetyTestLink($value);

    /**
     * get safety_test_link
     * @return string
     */
    public function getSafetyTestLink();

    /**
     * Set fda_test_link
     * @param string $value
     * @return $this
     */
    public function setFdaTestLink($value);

    /**
     * get fda_test_link
     * @return string
     */
    public function getFdaTestLink();

    /**
     * Set safety_test_date
     * @param string $value
     * @return $this
     */
    public function setSafetyTestDate($value);

    /**
     * get safety_test_date
     * @return string
     */
    public function getSafetyTestDate();

    /**
     * Set prop65_warning
     * @param boolean $value
     * @return $this
     */
    public function setProp65Warning($value);

    /**
     * get prop65_warning
     * @return boolean
     */
    public function getProp65Warning();

    /**
     * Set safety_test_available
     * @param boolean $value
     * @return $this
     */
    public function setSafetyTestAvailable($value);

    /**
     * get safety_test_available
     * @return boolean
     */
    public function getSafetyTestAvailable();


    /**
     * @return \Items\ItemInformation\Api\Data\SafetyDetailsExtensionInterface|null
     */
    public function getExtensionAttributes();
 
    /**
     * @param \Items\ItemInformation\Api\Data\SafetyDetailsExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\SafetyDetailsExtensionInterface $extensionAttributes);

}