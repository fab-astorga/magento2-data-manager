<?php

namespace Customers\Wishlist\Api;

/**
 * Interface WishlistManagementInterface
 */
interface WishlistManagementInterface
{

    /**
     * Save stock art cover
     *
     * @param int $customerId
     * @param int $wishlistId
     * @return boolean
     */
    public function createWishlist($customerId,$wishlistId);


    /**
     * Retrieve wishlist by attribute
     *
     * @param int $wishlistId
     * @return $wishlist
     * */
    public function getWishlist($wishlistId);

    /**
     * @param int $wishlistId
     * @param int $productId
     * @return boolean
     */
    public function saveItem($wishlistId,$productId);

    /**
     * @param int $productId
     * @return boolean
     */
    public function deleteItem($productId);

    /**
     * @param int $wishlistId
     * @return boolean
     */
    public function deleteWishlist($wishlistId);

    /**
     * @param string $distributorEmail
     * @param int $wishlistId
     * @return boolean
     */
    public function sendEmail($distributorEmail,$wishlistId);
    
}