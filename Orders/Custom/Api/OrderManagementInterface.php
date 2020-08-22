<?php

namespace Orders\Custom\Api;

interface OrderManagementInterface 
{
    /**
     * Create new order for a customer
     * 
     * @return string
     */
    public function createOrUpdateOrder();

    /**
     * Update an order of a customer
     * 
     * @return string
     */
    public function updateOrder();

    /**
     * Delete order
     * 
     * @return string
     */
    public function deleteOrder();
}