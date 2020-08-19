<?php

namespace Customers\Wishlist\Model;

use Exception;

use Customers\Wishlist\Api\Data\WishlistItemInterface;
use Customers\Wishlist\Api\WishlistItemRepositoryInterface;
use Customers\Wishlist\Model\WishlistItemFactory;
use Customers\Wishlist\Model\ResourceModel\WishlistItem as ResourceModelWishlistItem;
use Customers\Wishlist\Model\ResourceModel\WishlistItem\Collection;
use Customers\Wishlist\Model\ResourceModel\WishlistItem\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class WishlistItemRepository
 */
class WishlistItemRepository implements WishlistItemRepositoryInterface
{
    /**
     * @var WishlistItemFactory
     */
    private $_wishlistItemFactory;

    /**
     * @var ResourceModelWishlistItem
     */
    private $_resourceModelWishlistItem;

    /**
     * @var CollectionFactory
     */
    private $_wishlistItemCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    /**
     * wishlistItemRepository constructor.
     *
     * @param WishlistItemFactory $wishlistItemFactory
     * @param ResourceModelWishlistItem $resourceModelWishlistItem
     * @param CollectionFactory $wishlistItemCollectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct(
        WishlistItemFactory $wishlistItemFactory,
        ResourceModelWishlistItem $resourceModelWishlistItem,
        CollectionFactory $wishlistItemCollectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ){
        $this->_wishlistItemFactory                            = $wishlistItemFactory;
        $this->_resourceModelWishlistItem                      = $resourceModelWishlistItem;
        $this->_wishlistItemCollectionFactory                  = $wishlistItemCollectionFactory;
        $this->_collectionProcessor                            = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor               = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($wishlistId,$productId)
    {
        $wishlistItem = $this->_wishlistItemFactory->create();

        $wishlistItem->setWishlist($wishlistId);
        $wishlistItem->setWishlistItem($productId);
        $this->_resourceModelWishlistItem->save($wishlistItem);
        return $wishlistItem;
    }

    /**
     * @inheritdoc
     */
    public function get($value, $attributeCode = null)
    {
        /** @var WishlistItem $wishlistItem */
        $wishlistItem = $this->_wishlistItemFactory->create()->load($value, $attributeCode);

        if (!$wishlistItem->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity'));
        }

        return $wishlistItem;
    }

    /**
     * @inheritdoc
     */
    public function delete(WishlistItemInterface $wishlistItem)
    {
        $wishlistItemId = $wishlistItem->getId();
        try { 
            $this->_resourceModelWishlistItem->delete($wishlistItem);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(
                __('Unable to remove item %1', $wishlistItemId)
            );
        }
        return true;
    }

    /**
     * @return $wishlistItem
     */
    public function getById($productId)
    {
        return $this->get($productId);
    }

    /**
    * @inheritdoc
    */
    public function getCollection()
    {
        $collection = $this->_wishlistItemCollectionFactory->create();
        $itemsArray = array();

        foreach ($collection as $item){

            $itemsArray [] = $this->getById($item->getId());
        }

        return $itemsArray;
    }
}