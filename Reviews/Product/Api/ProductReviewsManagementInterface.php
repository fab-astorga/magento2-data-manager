<?php

namespace Reviews\Product\Api;

interface ProductReviewsManagementInterface 
{ 
    /**
     * Create a new review for some product
     * 
     * @param string $productId  
     * @param int $score
     * @param string $nickname
     * @param string $title
     * @param string $detail
     * @return boolean
     */
    public function createProductReview($productId, $score, $nickname, $title, $detail);

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
     * Get global rating of a product
     * 
     * @param int $productId
     * @return int
     */
    public function getProductRating($productId);
}