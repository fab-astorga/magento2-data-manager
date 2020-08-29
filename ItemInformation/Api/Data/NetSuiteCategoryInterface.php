<?php
namespace Items\ItemInformation\Api\Data;

Interface NetSuiteCategoryInterface extends \Magento\Framework\Api\ExtensibleDataInterface {
    
    const NETSUITE_ID = 'netsuite_id';

    const CATEGORY_ID = 'category_id';

    const ATTRIBUTES = [
        self::CATEGORY_ID,
        self::NETSUITE_ID
    ];

    /**
     * Set netsuite_id
     * @param int $value
     * @return $this
     */
    public function setNetSuiteCategoryId($value);

    /**
     * get netsuite_id
     * @return int
     */
    public function getNetSuiteCategoryId();

    /**
     * Set category_id
     * @param int $value
     * @return $this
     */
    public function setCategoryId($value);

    /**
     * get category_id
     * @return int
     */
    public function getCategoryId();


    /**
     * @return \Items\ItemInformation\Api\Data\NetSuiteCategoryExtensionInterface|null
     */
    public function getExtensionAttributes();
 
    /**
     * @param \Items\ItemInformation\Api\Data\NetSuiteCategoryExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\NetSuiteCategoryExtensionInterface $extensionAttributes);

}