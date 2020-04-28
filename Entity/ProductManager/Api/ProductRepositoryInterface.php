<?php

namespace Entity\ProductManager\Api;

/**
 * Rest API
 */
interface ProductRepositoryInterface
{
    /**
     * Create new product
     * @return string
     */
    public function createProduct();
}