<?php
namespace TestOrder\Custom\Api\Data;

Interface AttributeInterface {
    /**
     * Set order id
     * @param string $value
     * @return $this
     */
    public function setOrderId($value);

    /**
     * get order id
     * @return string
     */
    public function getOrderId();

    /**
     * Set bar
     * @param string $value
     * @return $this
     */
    public function setBar($value);

    /**
     * get bar
     * @return string
     */
    public function getBar();
}