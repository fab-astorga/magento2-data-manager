<?php

namespace Customers\Wishlist\Api;

use Customers\Wishlist\Api\Data\WishlistInterface;
/**
 * Interface WishlistRepositoryInterface
 */
interface WishlistRepositoryInterface
{

    /**
     * Save wishlist
     *
     * @param string $name
     * @return \Customers\Wishlist\Api\Data\WishlistInterface
     */
    public function save($name);


    /**
     * Retrieve wishlist by attribute
     *
     * @param $value
     * @param string|null $attributeCode
     * @return \Customers\Wishlist\Api\Data\WishlistInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($value, $attributeCode);

    /**
     * Delete $wishlist.
     * @param WishlistInterface $wishlist
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(WishlistInterface $wishlist);
    
}