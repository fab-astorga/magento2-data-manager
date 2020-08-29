<?php
namespace Items\ItemInformation\Api;

interface SafetyDetailsManagementInterface {
 
    /**
     * Returns true if the safety details saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $safetyDetailsInformation
     * @return boolean
     */
    public function saveSafetyDetails($product, $safetyDetailsInformation);


}