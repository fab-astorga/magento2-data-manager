<?php
namespace Items\ItemInformation\Api\Data;

Interface PriceListInterface {

    /**#@+
     * Constants defined for keys of  data array
     */
    /** USA **/
    const NET_PRICE_USA = 'net_price_usa';
    const EQP_USA = 'eqp_usa';
    const PROMOTION_USA = 'promotion_usa';
    const RETAIL_PRICE_USA = 'retail_price_usa';
    const SALE_PRICE_USA = 'sale_price_usa';
    const SALE_PRICE_ONLINE_USA = 'sale_price_online_usa';
    const SAMPLE_PRICE_USA = 'sample_price_usa';
    const ONLINE_PRICE_USA = 'online_price_usa';

    /** CANADA **/
    const NET_PRICE_CANADA = 'net_price_canada';
    const EQP_CANADA = 'eqp_canada';
    const PROMOTION_CANADA = 'promotion_canada';
    const RETAIL_PRICE_CANADA = 'retail_price_canada';
    const SALE_PRICE_CANADA = 'sale_price_canada';
    const SALE_PRICE_ONLINE_CANADA = 'sale_price_online_canada';
    const SAMPLE_PRICE_CANADA = 'sample_price_canada';
    const ONLINE_PRICE_CANADA = 'online_price_canada';

    /*******************************************  USA ****************************************************/
    
   /**
     * Set net_price_usa
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setNetPriceUsa($value);

    /**
     * get net_price_usa
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getNetPriceUsa();

    /**
     * Set eqp_usa
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setEQPUsa($value);

    /**
     * get eqp_usa
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getEQPUsa();

    /**
     * Set promotion_usa
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setPromotionUsa($value);

    /**
     * get promotion_usa
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getPromotionUsa();

    /**
     * Set retail_price_usa
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setRetailPriceUsa($value);

    /**
     * get retail_price_usa
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getRetailPriceUsa();

    /**
     * Set sale_price_usa
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setSalePriceUsa($value);

    /**
     * get sale_price_usa
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getSalePriceUsa();

    /**
     * Set sale_price_online_usa
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setSalePriceOnlineUsa($value);

    /**
     * get sale_price_online_usa
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getSalePriceOnlineUsa();

    /**
     * Set sample_price_usa
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setSamplePriceUsa($value);

    /**
     * get sample_price_usa
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getSamplePriceUsa();

    /**
     * Set online_price_usa
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setOnlinePriceUsa($value);

    /**
     * get online_price_usa
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getOnlinePriceUsa();


    /*******************************************  CANADA ****************************************************/


     /**
     * Set net_price_canada
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setNetPriceCanada($value);

    /**
     * get net_price_canada
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getNetPriceCanada();

    /**
     * Set eqp_canada
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setEQPCanada($value);

    /**
     * get eqp_canada
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getEQPCanada();

    /**
     * Set promotion_canada
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setPromotionCanada($value);

    /**
     * get promotion_canada
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getPromotionCanada();

    /**
     * Set retail_price_canada
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setRetailPriceCanada($value);

    /**
     * get retail_price_canada
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getRetailPriceCanada();

    /**
     * Set sale_price_canada
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setSalePriceCanada($value);

    /**
     * get sale_price_canada
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getSalePriceCanada();

    /**
     * Set sale_price_online_canada
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setSalePriceOnlineCanada($value);

    /**
     * get sale_price_online_canada
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getSalePriceOnlineCanada();

    /**
     * Set sample_price_canada
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setSamplePriceCanada($value);

    /**
     * get sample_price_canada
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getSamplePriceCanada();

    /**
     * Set online_price_canada
     * @param \Items\ItemInformation\Api\Data\PricesInterface[] $values
     * @return $this
     */
    public function setOnlinePriceCanada($value);

    /**
     * get online_price_canada
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getOnlinePriceCanada();


}