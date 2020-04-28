<?php
namespace TestProduct\Custom\Api\Data;

Interface AttributeInterface {
    /**
     * Set product id
     * @param int $value
     * @return $this
     */
    public function setEntityId($value);

    /**
     * get product id
     * @return int
     */
    public function getEntityId();

    /**
     * Set qty
     * @param float $value
     * @return $this
     */
    public function setQty48($value);

    /**
     * get qty
     * @return float
     */
    public function getQty48();
    /**
     * Set qty
     * @param float $value
     * @return $this
     */
    public function setQty144($value);

    /**
     * get qty
     * @return float
     */
    public function getQty144();
    /**
     * Set qty
     * @param float $value
     * @return $this
     */
    public function setQty288($value);

    /**
     * get qty
     * @return float
     */
    public function getQty288();
    /**
     * Set qty
     * @param float $value
     * @return $this
     */
    public function setQty576($value);

    /**
     * get qty
     * @return float
     */
    public function getQty576();
    /**
     * Set qty
     * @param float $value
     * @return $this
     */
    public function setQty1008($value);

    /**
     * get qty
     * @return float
     */
    public function getQty1008();
}