<?php

namespace Services\ProductVideos\Api;

interface ProductVideosManagementInterface 
{ 
    /**
     * Get all product videos
     * 
     * @return $this
     */
    public function getProductVideos();
}