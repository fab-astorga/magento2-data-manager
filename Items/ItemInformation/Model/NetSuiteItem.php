<?php
namespace Items\ItemInformation\Model;

Class NetSuiteItem extends \Magento\Framework\Model\AbstractExtensibleModel implements \Items\ItemInformation\Api\Data\NetSuiteItemInterface 
{
    
    protected function _construct()
    {
        $this->_init('Items\ItemInformation\Model\ResourceModel\NetSuiteItem');
    }

    /**
     * Set netsuite_id
     * @param int $value
     * @return $this
     */
    public function setNetSuiteItemId($value){
        return $this->setData(self::NETSUITE_ID, $value);
    }

    /**
     * get netsuite_id
     * @return int
     */
    public function getNetSuiteItemId(){
        return $this->getData(self::NETSUITE_ID);
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
     * @return \Items\ItemInformation\Api\Data\NetSuiteItemExtensionInterface|null
     */
    public function getExtensionAttributes(){

    }
 
    /**
     * @param \Items\ItemInformation\Api\Data\NetSuiteItemExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\NetSuiteItemExtensionInterface $extensionAttributes){

    }

}