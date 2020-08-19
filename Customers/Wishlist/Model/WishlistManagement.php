<?php

namespace Customers\Wishlist\Model;

use Exception;

use Customers\Wishlist\Api\WishlistManagementInterface;
use Customers\Wishlist\Model\WishlistRepository;
use Customers\Wishlist\Model\WishlistItemRepository;
use Customers\Wishlist\Model\WishlistItemFactory;
use Customers\Wishlist\Model\WishlistFactory;
use Customers\CustomerWishlist\Model\CustomerWishlist;
use Customers\Wishlist\Model\ResourceModel\WishlistItem\CollectionFactory;
use \Customers\Wishlist\Helper\Email;
//use \Customers\EmailModule\Helper\Email as EmailModule;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;

class WishlistManagement implements WishlistManagementInterface
{
    /**
     * @var WishlistRepository
     */
    protected $_wishlistRepository;

    /**
     * @var WishlistFactory
     */
    protected $_wishlistFactory;

    /**
     * @var WishlistItemRepository
     */
    protected $_wishlistItemRepository;

    /**
     * @var WishlistItemFactory
     */
    protected $_wishlistItemFactory;

    /**
     * @var CollectionFactory
     */
    protected $_wishlistItemCollectionFactory;

    /**
     * @var ProductRepositoryInterface
     */
    protected $_productRepository;

    /**
     * @var Session
     */
    protected $_customerSession;

    /**
     * @var Context
     */
    protected $_context;

    /**
     * @var CustomerWishlist
     */
    protected $_customerWishlist;

    protected $_logger;

    /**
     * @var Email
     */
    protected $_emailManager;

    /**
     * @var EmailModule
     */
    protected $_emailModule;

    public function __construct(
        WishlistRepository $wishlistRepository,
        WishlistItemFactory $wishlistItemFactory,
        WishlistFactory $wishlistFactory,
        WishlistItemRepository $wishlistItemRepository,
        CollectionFactory $wishlistItemCollectionFactory,
        ProductRepositoryInterface $productRepository,
        CustomerWishlist $customerWishlist,
        Email $emailManager,
        //EmailModule $emailModule,
        Session $customerSession,
        Context $context,
        \File\CustomLog\Logger\Logger $logger
    ){
        $this->_wishlistRepository                     = $wishlistRepository;
        $this->_wishlistItemFactory                    = $wishlistItemFactory;
        $this->_wishlistFactory                        = $wishlistFactory;
        $this->_wishlistItemRepository                 = $wishlistItemRepository;
        $this->_wishlistItemCollectionFactory          = $wishlistItemCollectionFactory;
        $this->_productRepository                      = $productRepository;
        $this->_customerWishlist                       = $customerWishlist;
        $this->_emailManager                           = $emailManager;
        //$this->_emailModule                             = $emailModule;
        $this->_customerSession                        = $customerSession;
        $this->_context                                = $context->getRedirect();
        $this->_logger = $logger;
    }

    /**
     *
     * @return boolean
     */
    public function createWishlist($customerId,$wishlistId){

        if ($this->_customerSession->getMyValue() == $customerId){
            if ($wishlistId != null){
                $wishlist = $this->_wishlistRepository->get($wishlistId,'wishlist_id');
                $collection = $this->_wishlistItemRepository->getCollection();
                foreach ($collection as $item){
                        $this->_customerWishlist->saveProduct($item->getWishlistItem(),$customerId);
                        $this->deleteItem($item->getWishlistItem());
                    }
                $this->deleteWishlist($wishlistId);
                return true;
            }
        }
        else{
            return false;
        }
    }

    /**
     * @return $wishlist
     */
    public function getWishlist($wishlistId){
        try{
            $wishlist = $this->_wishlistRepository->get($wishlistId,'wishlist_id');
            return $wishlist;
        }catch (Exception $e) {
            $name = 'Custom Wishlist';
            $wishlist = $this->_wishlistRepository->save($name);
            return $wishlist;
        }
    }

    /**
     * @return boolean
     */
    public function saveItem($wishlistId,$productId){
        try{
            $wishlist = $this->getWishlist($wishlistId);
            $product = $this->_productRepository->getById($productId);
            $this->_wishlistItemRepository->save($wishlist->getId(),$productId);
            return true;
        }catch (Exception $e) {
            return false;
        }
    }

    /**
     *
     * @param integer $productId
     * @return boolean
     */
    public function deleteItem($productId){
        try{
            $wishlistItem = $this->_wishlistItemRepository->get($productId,'product_id');
            $this->_wishlistItemRepository->delete($wishlistItem);

            return true;
        }catch (NoSuchEntityException $e) {
            return false;
        }
    }

    /**
     * @param int $wishlistId
     * @return boolean
     */
    public function deleteWishlist($wishlistId){
        try{
            $wishlist = $this->_wishlistRepository->get($wishlistId,'wishlist_id');
            $this->_wishlistRepository->delete($wishlist);
            return true;
        }catch (NoSuchEntityException $e) {
            return false;
        }
    }

    /**
     * @param string $distributorEmail
     * @param int $wishlistId
     * @return boolean
     */
    public function sendEmail($distributorEmail,$wishlistId){
        try{
            $data = array();
            $wishlist = $this->_wishlistRepository->get($wishlistId,'wishlist_id');
            $collection = $this->_wishlistItemRepository->getCollection();
            foreach ($collection as $item){
                var_dump($item->getWishlistItem());
                $product = $this->_productRepository->getById($item->getWishlistItem());
                $item = [
                    'sku'       => $product->getSku(),
                    'name'      => $product->getName(),
                    'price'     => $product->getPrice(),
                    'weight'    => $product->getWeight()
                ]; 
                $data[] = $item;
            }
            /**send wishlist email*/
            $this->_emailManager->sendWishlistEmail($data,$distributorEmail);

            //$this->_emailModule->sendGSEmail($data);
            return true;

        }catch (NoSuchEntityException $e) {
            return false;
        }
        
    }

    
}