<?php
namespace Items\ItemInformation\Api\Data;

Interface ItemMainShotsInterface extends \Magento\Framework\Api\ExtensibleDataInterface {
    
    /**#@+
     * Constants defined for keys of  data array
     */
    const ITEM_ID = 'item_id';

    const ITEM_GROUP_SHOT = 'item_group_shot';

    const ITEM_GLAMOUR_SHOT = 'item_glamour_shot';

    const GLAMOUR_SHOT_ALT_1 = 'glamour_shot_alt_1';

    const GROUP_SHOT_ALT_1 = 'group_shot_alt_1';

    const GROUP_SHOT_ALT_2 = 'group_shot_alt_2';

    const LID_1_SHOT = 'lid_1_shot';

    const LID_2_SHOT = 'lid_2_shot';

    const GIFT_BOX_ALT_1 = 'gift_box_alt_1';

    const GIFT_BOX_ALT_2 = 'gift_box_alt_2';

    const ATTRIBUTES = [
        self::ITEM_ID,
        self::ITEM_GROUP_SHOT,
        self::ITEM_GLAMOUR_SHOT,
        self::GLAMOUR_SHOT_ALT_1,
        self::GROUP_SHOT_ALT_1,
        self::GROUP_SHOT_ALT_2,
        self::LID_1_SHOT,
        self::LID_2_SHOT,
        self::GIFT_BOX_ALT_1,
        self::GIFT_BOX_ALT_2
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
     * Set item_group_shot
     * @param string $value
     * @return $this
     */
    public function setItemGroupShot($value);

    /**
     * get item_group_shot
     * @return string
     */
    public function getItemGroupShot();

    /**
     * Set item_glamour_shot
     * @param string $value
     * @return $this
     */
    public function setItemGlamourShot($value);

    /**
     * get item_glamour_shot
     * @return string
     */
    public function getItemGlamourShot();

    /**
     * Set glamour_shot_alt_1
     * @param string $value
     * @return $this
     */
    public function setGlamourShotAlt1($value);

    /**
     * get glamour_shot_alt_1
     * @return string
     */
    public function getGlamourShotAlt1();

    /**
     * Set group_shot_alt_1
     * @param string $value
     * @return $this
     */
    public function setGroupShotAlt1($value);

    /**
     * get group_shot_alt_1
     * @return string
     */
    public function getGroupShotAlt1();

    /**
     * Set group_shot_alt_2
     * @param string $value
     * @return $this
     */
    public function setGroupShotAlt2($value);

    /**
     * get group_shot_alt_2
     * @return string
     */
    public function getGroupShotAlt2();

    /**
     * Set lid_1_shot
     * @param string $value
     * @return $this
     */
    public function setLid1shot($value);

    /**
     * get lid_1_shot
     * @return string
     */
    public function getLid1shot();

    /**
     * Set lid_2_shot
     * @param string $value
     * @return $this
     */
    public function setLid2shot($value);

    /**
     * get lid_2_shot
     * @return string
     */
    public function getLid2shot();

    /**
     * Set gift_box_alt_1
     * @param string $value
     * @return $this
     */
    public function setGiftBoxAlt1($value);

    /**
     * get gift_box_alt_1
     * @return string
     */
    public function getGiftBoxAlt1();

    /**
     * Set gift_box_alt_2
     * @param string $value
     * @return $this
     */
    public function setGiftBoxAlt2($value);

    /**
     * get gift_box_alt_2
     * @return string
     */
    public function getGiftBoxAlt2();


    /**
     * @return \Items\ItemInformation\Api\Data\ItemMainShotsExtensionInterface|null
     */
    public function getExtensionAttributes();
 
    /**
     * @param \Items\ItemInformation\Api\Data\ItemMainShotsExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\ItemMainShotsExtensionInterface $extensionAttributes);

}