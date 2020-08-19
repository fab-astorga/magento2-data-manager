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
     * Delete order
     * 
     * @return string
     */
    public function deleteOrder();
}