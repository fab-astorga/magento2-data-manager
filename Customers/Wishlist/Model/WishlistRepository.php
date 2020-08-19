<?php

namespace Customers\Wishlist\Model;

use Exception;

use Customers\Wishlist\Api\Data\WishlistInterface;
use Customers\Wishlist\Api\WishlistRepositoryInterface;
use Customers\Wishlist\Model\WishlistFactory;
use Customers\Wishlist\Model\ResourceModel\Wishlist as ResourceModelWishlist;
use Customers\Wishlist\Model\ResourceModel\Wishlist\Collection;
use Customers\Wishlist\Model\ResourceModel\Wishlist\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class WishlistRepository
 */
class WishlistRepository implements WishlistRepositoryInterface
{
    /**
     * @var WishlistFactory
     */
    private $_wishlistFactory;

    /**
     * @var ResourceModelWishlist
     */
    private $_resourceModelWishlist;

    /**
     * @var CollectionFactory
     */
    private $_wishlistCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    /**
     * wishlistRepository constructor.
     *
     * @param WishlistFactory $wishlistFactory
     * @param ResourceModelWishlist $resourceModelWishlist
     * @param CollectionFactory $wishlistCollectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct(
        WishlistFactory $wishlistFactory,
        ResourceModelWishlist $resourceModelWishlist,
        CollectionFactory $wishlistCollectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ){
        $this->_wishlistFactory                            = $wishlistFactory;
        $this->_resourceModelWishlist                      = $resourceModelWishlist;
        $this->_wishlistCollectionFactory                   = $wishlistCollectionFactory;
        $this->_collectionProcessor                        = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor           = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($name)
    {
        $wishlist = $this->_wishlistFactory->create();
        $wishlist->setName($name);
        $this->_resourceModelWishlist->save($wishlist);
        return $wishlist;
    }

    /**
     * @inheritdoc
     */
    public function get($value, $attributeCode = null)
    {
        /** @var Wishlist $wishlist */
        $wishlist = $this->_wishlistFactory->create()->load($value, $attributeCode);

        if (!$wishlist->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity'));
        }

        return $wishlist;
    }

    /**
     * @inheritdoc
     */
    public function delete(WishlistInterface $wishlist)
    {
        $wishlistId = $wishlist->getId();
        try {

            $this->_resourceModelWishlist->delete($wishlist);

        } catch (\Exception $e) {
            throw new CouldNotDeleteException(
                __('Unable to remove item %1', $wishlistItemId)
            );
        }
        return true;
    }
}