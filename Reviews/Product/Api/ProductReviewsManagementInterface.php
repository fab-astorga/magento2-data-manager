<?php

namespace Reviews\Product\Api;

interface ProductReviewsManagementInterface 
{ 
    /**
     * Create a new review for some product
     * 
     * @param int $productId  
     * @param float $score
     * @return boolean
     */
    public function createProductReview($productId, $score);

    /**
     * Get product reviews
     * 
     * @param int $productId
     * @return array
     */
    public function getProductReviews($productId);

    /**
     * Approve / not approve product review
     * $status = 1 : APPROVED
     * $status = 3 : NOT APPROVED
     *
     * @param int $reviewId
     * @param int $status
     * @return boolean
     */
    public function approveProductReview($reviewId, $status);

    /**
     * Get amount of reviews of a product
     * 
     * @param int $productId
     * @return int
     */
    public function getProductAmountReviews($productId);

    /**
     * Get global rating of a product
     * 
     * @param int $productId
     * @return int
     */
    public function getProductRating($productId);

    /**
     * Get products best sellers
     * 
     * @return array
     */
    public function getBestSellers();
}