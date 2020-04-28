<?php
namespace TestOrder\Custom\Api;
interface CustomOrderInterface {
    /**
     * 
     * @return \Magento\Sales\Api\Data\OrderInterface
     */
    public function getOrders();

        /**
     * 
     * @return \Magento\Sales\Api\Data\OrderInterface
     */
    public function updateOrder();

}