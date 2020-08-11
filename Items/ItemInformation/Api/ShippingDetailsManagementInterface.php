<?php
namespace Items\ItemInformation\Api;

interface ShippingDetailsManagementInterface {
 
    /**
     * Returns true if the shipping details saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $shippingDetailsInformation
     * @return boolean
     */
    public function saveShippingDetails($product, $shippingDetailsInformation);


}