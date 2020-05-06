<?php

namespace DistributorTools\StockArtLibrary\Api;

interface StockArtLibraryManagementInterface {
 
    /**
     * POST from NetSuite with Stock Art Library
     * @return boolean
     */
    public function saveStockArtLibrary();

    /**
     * POST from NetSuite with single Stock Art Cover
     * @return boolean
     */
    public function saveCover();
    
    /**
     * POST from NetSuite with single Stock Art Image
     * @return boolean
     */
    public function saveCoverImage();

    /**
     * DELETE cover from NetSuite
     * @return boolean
     */
    public function deleteCover();  //id 

    /**
     * DELETE image cover from NetSuite
     * @return boolean
     */
    public function deleteCoverImage(); //id
}