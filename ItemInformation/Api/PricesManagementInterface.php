<?php
namespace Items\ItemInformation\Api;

interface PricesManagementInterface 
{
    /**
     * Returns true if the prices saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $pricesInformation
     * @return boolean
     */
    public function savePrices($product, $pricesInformation);

    /**
     * Save prices array
     * @param string $priceTable
     * @param array $prices
     * @return boolean
     */
    public function savePricesArray($priceTable, $prices, $productId);

    /**
     * Get USA Price Table
     * @param string $currency
     * @param array $priceLevel
     * @return string
     */
    public function getUSAPriceTable($priceLevel);

    /**
     * Get Canadian Price Table
     * @param string $currency
     * @param array $priceLevel
     * @return string
     */
    public function getCanadianPriceTable($priceLevel);


    /**
     * Get All Product Prices
     * @param int $productId
     * @return \Items\ItemInformation\Api\Data\PriceListInterface
     */
    public function getAllProductPrices($productId);


    /**
     * Get Prices List Array
     * @param int $productId
     * @param string $priceLevel
     * @return \Items\ItemInformation\Api\Data\PricesInterface[]
     */
    public function getPricesListArray($productId, $priceLevel);


    /**
     * Set final product price
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @return boolean
     */
    public function setFinalProductPrice($productId);    
}