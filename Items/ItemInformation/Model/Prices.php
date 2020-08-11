<?php
namespace Items\ItemInformation\Model;

Class Prices extends \Magento\Framework\Model\AbstractExtensibleModel implements \Items\ItemInformation\Api\Data\PricesInterface 
{

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
     * Set min_quantity
     * @param string $value
     * @return $this
     */
    public function setMinQuantity($value){
        return $this->setData(self::MIN_QUANTITY, $value);
    }

    /**
     * get min_quantity
     * @return string
     */
    public function getMinQuantity(){
        return $this->getData(self::MIN_QUANTITY);
    }

    /**
     * Set unit_price
     * @param string $value
     * @return $this
     */
    public function setUnitPrice($value){
        return $this->setData(self::UNIT_PRICE, $value);
    }

    /**
     * get unit_price
     * @return string
     */
    public function getUnitPrice(){
        return $this->getData(self::UNIT_PRICE);
    }

    /**
     * @return \Items\ItemInformation\Api\Data\PricesExtensionInterface|null
     */
    public function getExtensionAttributes(){

    }
 
    /**
     * @param \Items\ItemInformation\Api\Data\PricesExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ItemInformation\Api\Data\PricesExtensionInterface $extensionAttributes){

    }

}