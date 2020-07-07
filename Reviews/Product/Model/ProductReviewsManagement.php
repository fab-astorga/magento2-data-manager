<?php
namespace Reviews\Product\Model;

use Exception;
use Reviews\Product\Api\ProductReviewsManagementInterface;

class ProductReviewsManagement implements ProductReviewsManagementInterface 
{
    const REVIEW_TABLE = 'review';
    const REVIEW_ID    = 'review_id';
    const RATINGS      = 'ratings';
    const NICKNAME     = 'nickname';
    const TITLE        = 'title';
    const DETAIL       = 'detail';
    const STATUS_ID    = 'status_id';
    const PRODUCT      = 'product';
    const STARS        = 5;
    const ERROR        = -1;
    const NO_REVIEWS   = 0;

    protected $_reviewFactory;
    protected $_reviewCollectionFactory;
    protected $_ratingFactory;
    protected $_productRepository;
    protected $_storeManager;
    protected $_resourceConnection;
    protected $_productCollection;
    protected $_logger;

    public function __construct(
        \Magento\Review\Model\ReviewFactory $reviewFactory,
        \Magento\Review\Model\ResourceModel\Review\CollectionFactory $reviewCollectionFactory,
        \Magento\Review\Model\RatingFactory $ratingFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\ResourceConnection $resourceConnection,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollection,
        \File\CustomLog\Logger\Logger $logger

    ) 
    {
        $this->_reviewFactory           = $reviewFactory;
        $this->_reviewCollectionFactory = $reviewCollectionFactory;
        $this->_ratingFactory           = $ratingFactory;
        $this->_productRepository       = $productRepository;
        $this->_storeManager            = $storeManager;
        $this->_resourceConnection      = $resourceConnection;
        $this->_productCollection       = $productCollection;
        $this->_logger                  = $logger;
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function createProductReview($productId, $score)
    {
        $intScore = (int)round($score);

        if ( $intScore>5 || $intScore<1 ) {
            return "Score must be a number among 1 and 5";
        }

        $reviewFinalData['ratings'][1] = $intScore; // Score
        $reviewFinalData[self::NICKNAME] = "";
        $reviewFinalData[self::TITLE] = "";
        $reviewFinalData[self::DETAIL] = "";
        $review = $this->_reviewFactory->create()->setData($reviewFinalData);
        $review->unsetData(self::REVIEW_ID);
        $review->setEntityId($review->getEntityIdByCode(\Magento\Review\Model\Review::ENTITY_PRODUCT_CODE))
            ->setEntityPkValue($productId)
            ->setStatusId(\Magento\Review\Model\Review::STATUS_PENDING)// approve or pending
            ->setStoreId($this->_storeManager->getStore()->getId())
            ->setStores([$this->_storeManager->getStore()->getId()])
            ->save();

        foreach ($reviewFinalData[self::RATINGS] as $ratingId => $optionId) 
        {
            $this->_ratingFactory->create()
                ->setRatingId($ratingId)
                ->setReviewId($review->getId())
                ->addOptionVote($optionId, $productId);
        }
        
        $review->aggregate();
        return true;
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function getProductReviews($productId)
    {
        $currentStoreId = $this->_storeManager->getStore()->getId();
        $rating = $this->_reviewCollectionFactory->create();

        $collection = $rating->addStoreFilter(
                        $currentStoreId
                    )->addStatusFilter(
                        \Magento\Review\Model\Review::STATUS_APPROVED
                    )->addEntityFilter(
                        self::PRODUCT,
                        $productId
                    )->setDateOrder();

        return $collection->getData();
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function approveProductReview($reviewId, $status)
    {
        $connection = $this->_resourceConnection->getConnection();

        $sql = "UPDATE " . self::REVIEW_TABLE . " 
                SET ". self::STATUS_ID ."=".$status." 
                WHERE " . self::REVIEW_ID . "=".$reviewId."" ; 
        $connection->query($sql);
        return true;
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function getProductAmountReviews($productId)
    {
        try {
            $product = $this->_productRepository->getById($productId);

        } catch (Exception $exception) {
                return self::ERROR;
        }

        if ( empty($this->getProductReviews($productId)) ) {
            return self::NO_REVIEWS;
        }

        $this->_reviewFactory->create()->getEntitySummary($product, $this->_storeManager->getStore()->getId());
        $reviewCount = $product->getRatingSummary()->getReviewsCount();

        return (int)$reviewCount;
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function getProductRating($productId)

    {
        try {
            $product = $this->_productRepository->getById($productId);

        } catch (Exception $exception) {
                return self::ERROR;
        }

        if ( empty($this->getProductReviews($productId)) ) {
            return self::STARS;
        }

        $this->_reviewFactory->create()->getEntitySummary($product, $this->_storeManager->getStore()->getId());
        $ratingSummary = $product->getRatingSummary()->getRatingSummary();
        $ratingStars = (int)round( ($ratingSummary/100) * self::STARS );

        return $ratingStars;
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function getBestSellers()
    {
        $products = $this->_productCollection->create();
        $productRating = array();
        $response = array();

        /** Calculates rating of each product */
        foreach ($products as $product)
        {
            $product = $this->_productRepository->getById($product->getId());

            $this->_logger->info('product sku: ' . $product->getSku());

            if (empty($this->getProductReviews($product->getId()))) 
            {
                $productRating[] = array("product_id"=>$product->getId(), "average"=>100);
            } 
            else 
            {
                $this->_reviewFactory->create()->getEntitySummary($product, $this->_storeManager->getStore()->getId());
                $ratingSummary = $product->getRatingSummary()->getRatingSummary();
                $productRating[] = array("product_id"=>$product->getId(),"average"=>(int)$ratingSummary);
            }
        }

        /** Sort products by rating */
        foreach ($productRating as $key => $value) {
            $average[$key] = $value['average'];
        }
        array_multisort($average, SORT_DESC, $productRating);

        /** Create an array with product object and amount of stars of each product */
        foreach ($productRating as $pr)
        {
            $product = $this->_productRepository->getById($pr['product_id']);
            $ratingStars = (int)round(($pr['average']/100) * self::STARS);
            $response[] = array("product"=>$product, "rating"=>$ratingStars);
        }

        return $response;
    }
}