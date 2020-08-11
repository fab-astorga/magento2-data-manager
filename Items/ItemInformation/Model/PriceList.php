<?php
namespace Items\ItemInformation\Model;

Class PriceList extends \Magento\Framework\Model\AbstractExtensibleModel implements \Items\ItemInformation\Api\Data\PriceListInterface 
{

    /*******************************************  USA ****************************************************/

    /**
     * Set net_price_usa
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setNetPriceUsa($value){
        return $this->setData(self::NET_PRICE_USA, $value);
    }

    /**
     * get net_price_usa
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getNetPriceUsa(){
        return $this->getData(self::NET_PRICE_USA);
    }
    /**
     * Set eqp_usa
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setEQPUsa($value){
        return $this->setData(self::EQP_USA, $value);
    }

    /**
     * get eqp_usa
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getEQPUsa(){
        return $this->getData(self::EQP_USA);
    }

    /**
     * Set promotion_usa
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setPromotionUsa($value){
        return $this->setData(self::PROMOTION_USA, $value);
    }

    /**
     * get promotion_usa
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getPromotionUsa(){
        return $this->getData(self::PROMOTION_USA);
    }

    /**
     * Set retail_price_usa
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setRetailPriceUsa($value){
        return $this->setData(self::RETAIL_PRICE_USA, $value);
    }

    /**
     * get retail_price_usa
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getRetailPriceUsa(){
        return $this->getData(self::RETAIL_PRICE_USA);
    }

    /**
     * Set sale_price_usa
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setSalePriceUsa($value){
        return $this->setData(self::SALE_PRICE_USA, $value);
    }

    /**
     * get sale_price_usa
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getSalePriceUsa(){
        return $this->getData(self::SALE_PRICE_USA);
    }

    /**
     * Set sale_price_online_usa
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setSalePriceOnlineUsa($value){
        return $this->setData(self::SALE_PRICE_ONLINE_USA, $value);
    }

    /**
     * get sale_price_online_usa
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getSalePriceOnlineUsa(){
        return $this->getData(self::SALE_PRICE_ONLINE_USA);
    }

    /**
     * Set sample_price_usa
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setSamplePriceUsa($value){
        return $this->setData(self::SAMPLE_PRICE_USA, $value);
    }

    /**
     * get sample_price_usa
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getSamplePriceUsa(){
        return $this->getData(self::SAMPLE_PRICE_USA);
    }

    /**
     * Set online_price_usa
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setOnlinePriceUsa($value){
        return $this->setData(self::ONLINE_PRICE_USA, $value);
    }

    /**
     * get online_price_usa
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getOnlinePriceUsa(){
        return $this->getData(self::ONLINE_PRICE_USA);
    }

    /*******************************************  CANADA ****************************************************/

    /**
     * Set net_price_canada
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setNetPriceCanada($value){
        return $this->setData(self::NET_PRICE_CANADA, $value);
    }

    /**
     * get net_price_canada
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getNetPriceCanada(){
        return $this->getData(self::NET_PRICE_CANADA);
    }
    /**
     * Set eqp_canada
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setEQPCanada($value){
        return $this->setData(self::EQP_CANADA, $value);
    }

    /**
     * get eqp_canada
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getEQPCanada(){
        return $this->getData(self::EQP_CANADA);
    }

    /**
     * Set promotion_canada
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setPromotionCanada($value){
        return $this->setData(self::PROMOTION_CANADA, $value);
    }

    /**
     * get promotion_canada
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getPromotionCanada(){
        return $this->getData(self::PROMOTION_CANADA);
    }

    /**
     * Set retail_price_canada
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setRetailPriceCanada($value){
        return $this->setData(self::RETAIL_PRICE_CANADA, $value);
    }

    /**
     * get retail_price_canada
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getRetailPriceCanada(){
        return $this->getData(self::RETAIL_PRICE_CANADA);
    }

    /**
     * Set sale_price_canada
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setSalePriceCanada($value){
        return $this->setData(self::SALE_PRICE_CANADA, $value);
    }

    /**
     * get sale_price_canada
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getSalePriceCanada(){
        return $this->getData(self::SALE_PRICE_CANADA);
    }

    /**
     * Set sale_price_online_canada
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setSalePriceOnlineCanada($value){
        return $this->setData(self::SALE_PRICE_ONLINE_CANADA, $value);
    }

    /**
     * get sale_price_online_canada
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getSalePriceOnlineCanada(){
        return $this->getData(self::SALE_PRICE_ONLINE_CANADA);
    }

    /**
     * Set sample_price_canada
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setSamplePriceCanada($value){
        return $this->setData(self::SAMPLE_PRICE_CANADA, $value);
    }

    /**
     * get sample_price_canada
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getSamplePriceCanada(){
        return $this->getData(self::SAMPLE_PRICE_CANADA);
    }

    /**
     * Set online_price_canada
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setOnlinePriceCanada($value){
        return $this->setData(self::ONLINE_PRICE_CANADA, $value);
    }

    /**
     * get online_price_canada
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getOnlinePriceCanada(){
        return $this->getData(self::ONLINE_PRICE_CANADA);
    }


}