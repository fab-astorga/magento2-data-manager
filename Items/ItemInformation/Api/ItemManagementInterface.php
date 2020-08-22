<?php
namespace Items\ItemInformation\Api;

interface ItemManagementInterface 
{    
    // Incoming JSON fields mapping
    const ITEM_MAIN_INFORMATION = "drinkware_type";
    const PRICES                = "prices";
    const RELATED_ITEMS         = "related_items";
    const SUB_ITEM_OF           = 'sub_item_of';
    const CATEGORY              = 'category';
    const NON_INVENTORY         = 'non inventory';
    const NETSUITE_ID           = 'netsuite_id';
    const SKU                   = 'sku';
    const DEFAULT_STORE_ID      = 0;
    const DEFAULT_QUANTITY      = 100;
    
    /**
     * POST or PUT from NetSuite with item information
     * Works for updating or creating an item
     * @return string
     */
    public function saveOrUpdateItem();

    /**
     * Save item related items
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $relatedItems
     * @return string
     */
    public function saveRelatedItems($product, $relatedItems);

    /**
     * Save categories
     * POST from NetSuite with categories Information
     * @return string
     */
    public function saveCategories();

    /**
     * Delete category
     * POST from NetSuite in order to delete an specific category
     * @return string
     */
    public function deleteCategory();

    /**
     * DELETE item from Netsuite with the netsuite ID
     * @return string
     */
    public function deleteItem();

    /**
     * Save item main information
     * @param array $itemInformation
     * @return \Magento\Catalog\Api\Data\ProductInterface
     */
    public function saveItemMainInformation($itemInformation);

    /**
     * Get a subset of key the incoming json
     * @param array $setOfKeys
     * @param array $data
     * @return array
     */
    public function getExistingKeys($setOfKeys, $data);

    /**
     * Get a subset of key the incoming json
     * @param string $configurableSku
     * @param \Magento\Catalog\Api\Data\ProductInterface $currentProduct
     * @return bool
     */
    public function setSimpleProductToConfigurable($configurableSku, $currentProduct);

    /**
     * Set special categories
     * @param string \Magento\Catalog\Api\Data\ProductInterface $currentProduct
     * @param array $itemInformation
     * @return bool
     */
    public function setSpecialCategories($currentProduct, $itemInformation);

    /**
     * Set category to configurable products (Temporal solution)
     * 
     * @param int $parentCategoryId
     * @param int $productId
     * @return bool
     */
    public function assignCategoryToConfigurableProduct($parentCategoryId, $productId);

    /**
     * Set category to simple products or configurable products without children
     * 
     * @param string $productSku
     * @param int $categoryId
     * @return bool
     */
    public function assignCategoryToProduct($productSku, $categoryId);

    /**
     * Check inventory from Magento to Netsuite
     * 
     * @param int $itemId
     * @param int $quantity
     * @return boolean
     */
    public function checkInventory($itemId, $quantity);

    /**
     * Check total estimate shipping
     * 
     * @param int $zipCode
     * @param int $requestedQuantity
     * @return string
     */
    public function estimateShipping($zipCode, $requestedQuantity);
}