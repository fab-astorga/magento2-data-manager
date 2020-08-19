<?php

namespace Customers\Wishlist\Api;

use Customers\Wishlist\Api\Data\WishlistItemInterface;

/**
 * Interface WishlistItemRepositoryInterface
 */
interface WishlistItemRepositoryInterface
{

    /**
     * Save wihslistItem
     *
     * @param int $wishlistId
     * @param int $productId
     * @return \Customers\Wishlist\Api\Data\WishlistItemInterface
     */
    public function save($wishlistId,$productId);


    /**
     * Retrieve wishlistItem by attribute
     *
     * @param $value
     * @param string|null $attributeCode
     * @return \Customers\Wishlist\Api\Data\WishlistItemInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($value, $attributeCode);

    /**
     * Delete $wishlist.
     * @param WishlistItemInterface $wishlistItem
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(WishlistItemInterface $wishlistItem);

    /**
     * @param int $productId
     * @return $wishlistItem
     */
    public function getById($productId);

    /**
     * @return \Customers\Wishlist\Api\Data\WishlistItemInterface[]
     */
    public function getCollection();
    
}