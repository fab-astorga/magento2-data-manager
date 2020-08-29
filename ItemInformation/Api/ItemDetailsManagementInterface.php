<?php
namespace Items\ItemInformation\Api;

interface ItemDetailsManagementInterface {
 
    /**
     * Returns true if the item details saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $itemDetailsInformation
     * @return boolean
     */
    public function saveItemDetails($product, $itemDetailsInformation);


}