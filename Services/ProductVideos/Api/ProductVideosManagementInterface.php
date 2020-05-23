<?php

namespace Services\ProductVideos\Api;

interface ProductVideosManagementInterface 
{ 
    /**
     * Import CSV file with product videos information
     * 
     * @return boolean
     */
    public function importProductVideosFromCsv();

    /**
     * Get all product videos
     * 
     * @return $this
     */
    public function getProductVideos();
}