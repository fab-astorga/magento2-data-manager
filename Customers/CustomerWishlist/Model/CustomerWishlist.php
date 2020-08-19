<?php
namespace Customers\CustomerWishlist\Model;



class CustomerWishlist implements \Customers\CustomerWishlist\Api\CustomerWishlistInterface {
    

    /**
     *
     * @var \Magento\Wishlist\Model\WishlistFactory
     */
    protected $_wishlistRepository;

    /**
     *
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $_productRepository;

    /**
     *
     * @var \Magento\Wishlist\Model\Wishlist
     */
    protected $_wishlist;

    public function __construct(
            \Magento\Wishlist\Model\WishlistFactory $wishlistRepository,
            \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
            \Magento\Wishlist\Model\Wishlist $wishlist
    ) {
        $this->_wishlistRepository  = $wishlistRepository;
        $this->_productRepository   = $productRepository;
        $this->_wishlist            = $wishlist;
    }


    /**
     * save product in customer wishlist
     *
     * @param integer $productId
     * @param integer $customerId
     * @return void
     */
    public function saveProduct($productId,$customerId){
        try {
            $product = $this->_productRepository->getById($productId);
            $wishlist = $this->_wishlistRepository->create()->loadByCustomerId($customerId, true);
            $wishlist->addNewItem($product);
            $wishlist->save();

            return true;

        } catch (NoSuchEntityException $e) {
            $product = null;

            return false;
        }
        
    }
        

    /**
     * delete product from customer wishlist
     *
     * @param integer $customerId
     * @param integer $productId
     * @return boolean
     */
    public function deleteProduct($customerId,$productId){
        $flag = false;
        try{
            $wish = $this->_wishlist->loadByCustomerId($customerId);
            $items = $wish->getItemCollection();
            /** @var \Magento\Wishlist\Model\Item $item */
            foreach ($items as $item) {
                if ($item->getProductId() == $productId) {
                    $item->delete();
                    $wish->save();
                    $flag = true;
                }
            }

            return $flag;
        }catch (NoSuchEntityException $e) {
            return $flag;
        }

        
    }

    
    /**
    * @param int $customerId
    */
    public function getWishlistProducts($customerId)
    {
        $wishlist = $this->_wishlist->loadByCustomerId($customerId)->getItemCollection();
        return $wishlist;
    }

}