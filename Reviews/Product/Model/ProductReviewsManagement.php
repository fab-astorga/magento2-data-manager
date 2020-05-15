<?php
namespace Reviews\Product\Model;

use Reviews\Product\Api\ProductReviewsManagementInterface;

class ProductReviewsManagement implements ProductReviewsManagementInterface 
{
    const REVIEW_TABLE = 'review';
    const REVIEW_ID = 'review_id';
    const RATINGS = 'ratings';
    const NICKNAME = 'nickname';
    const TITLE = 'title';
    const DETAIL = 'detail';
    const STATUS_ID = 'status_id';
    const PRODUCT = 'product';

    protected $_reviewFactory;
    protected $_reviewCollectionFactory;
    protected $_ratingFactory;
    protected $_productRepository;
    protected $_storeManager;
    protected $_resourceConnection;

    public function __construct(
        \Magento\Review\Model\ReviewFactory $reviewFactory,
        \Magento\Review\Model\ResourceModel\Review\CollectionFactory $reviewCollectionFactory,
        \Magento\Review\Model\RatingFactory $ratingFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\ResourceConnection $resourceConnection
    ) 
    {
        $this->_reviewFactory           = $reviewFactory;
        $this->_reviewCollectionFactory = $reviewCollectionFactory;
        $this->_ratingFactory           = $ratingFactory;
        $this->_productRepository       = $productRepository;
        $this->_storeManager            = $storeManager;
        $this->_resourceConnection      = $resourceConnection;
        $this->_logger                  = $logger;
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function createProductReview($productId,  $score, $nickname, $title, $detail)
    {
        $reviewFinalData['ratings'][1] = $score;  //Quality
        $reviewFinalData['ratings'][2] = $score;  //Value
        $reviewFinalData['ratings'][3] = $score;  //Price
        $reviewFinalData[self::NICKNAME] = $nickname;
        $reviewFinalData[self::TITLE] = $title;
        $reviewFinalData[self::DETAIL] = $detail;
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
    public function getProductRating($productId)
    {
        $product = $this->_productRepository->getById($productId);
        $this->_reviewFactory->create()->getEntitySummary($product, $this->_storeManager->getStore()->getId());
        $ratingSummary = $product->getRatingSummary()->getRatingSummary();

        return $ratingSummary;
    }
}
