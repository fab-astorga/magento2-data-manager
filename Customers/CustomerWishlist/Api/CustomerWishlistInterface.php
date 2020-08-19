<?php
namespace Customers\CustomerWishlist\Api;

/**
 * Interface CustomerWishlistInterface
 * @api
 */
interface CustomerWishlistInterface {
    
 
    /**
     *
     * @param integer $productId
     * @param integer $customerId
     * @return boolean
     */
    public function saveProduct($customerId,$productId);

    
    /**
     * Undocumented function
     *
     * @param integer $customerId
     * @param integer $productId
     * @return boolean
     */
    public function deleteProduct($customerId,$productId);


    /**
     * 
     * @param integer $customerId
     * @return #wishlist
     */
    public function getWishlistProducts($customerId);


}