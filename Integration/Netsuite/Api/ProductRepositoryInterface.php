<?php

namespace Integration\Netsuite\Api;

/**
 * Rest API
 */
interface ProductRepositoryInterface
{
    /**
     * Get product by its ID
     * 
     * @param int $id
     * @return \Integration\Netsuite\Api\Data\ProductInterface
     * @throws NoSuchEntityException
     */
    public function getProductById($id);
}