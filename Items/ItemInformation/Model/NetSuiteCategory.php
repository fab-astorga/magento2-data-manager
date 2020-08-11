<?php
namespace Items\ItemInformation\Model;

Class NetSuiteCategory extends \Magento\Framework\Model\AbstractExtensibleModel implements \Items\ItemInformation\Api\Data\NetSuiteCategoryInterface 
{
    
    protected function _construct()
    {
        $this->_init('Items\ItemInformation\Model\ResourceModel\NetSuiteCategory');
    }

    /**
     * Set netsuite_id
     * @param int $value
     * @return $this
     */
    public function setNetSuiteCategoryId($value){
        return $this->setData(self::NETSUITE_ID, $value);
    }

    /**
     * get netsuite_id
     * @return int
     */
    public function getNetSuiteCategoryId(){
        return $this->getData(self::NETSUITE_ID);
    }

    /**
     * Set category_id
     * @param int $value
     * @return $this
     */
    public function setCategoryId($value){
        return $this->setData(self::CATEGORY_ID, $value);
    }

    /**
     * get category_id
     * @return int
     */
    public function getCategoryId(){
        return $this->getData(self::CATEGORY_ID);
    }

    /**
     * @return \Items\ItemInformation\Api\Data\NetSuiteCategoryExtensionInterface|null
     */
    public function getExtensionAttributes(){

    }
 
    /**
     * @param \Items\ItemInformation\Api\Data\NetSuiteCategoryExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\NetSuiteCategoryExtensionInterface $extensionAttributes){

    }

}