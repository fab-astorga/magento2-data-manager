<?php
namespace Items\ItemInformation\Api\Data;

Interface NetSuiteItemInterface extends \Magento\Framework\Api\ExtensibleDataInterface {
    
    const NETSUITE_ID = 'netsuite_id';

    const ITEM_ID = 'item_id';

    const ATTRIBUTES = [
        self::NETSUITE_ID,
        self::ITEM_ID
    ];

    /**
     * Set netsuite_id
     * @param int $value
     * @return $this
     */
    public function setNetSuiteItemId($value);

    /**
     * get netsuite_id
     * @return int
     */
    public function getNetSuiteItemId();

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
     * @return \Items\ItemInformation\Api\Data\NetSuiteItemExtensionInterface|null
     */
    public function getExtensionAttributes();
 
    /**
     * @param \Items\ItemInformation\Api\Data\NetSuiteItemExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\NetSuiteItemExtensionInterface $extensionAttributes);

}