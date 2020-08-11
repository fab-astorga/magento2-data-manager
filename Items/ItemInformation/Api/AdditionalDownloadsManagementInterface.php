<?php
namespace Items\ItemInformation\Api;

interface AdditionalDownloadsManagementInterface {
 
    /**
     * Returns true if the additional downloads saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $AdditionalDownloadsInformation
     * @return boolean
     */
    public function saveAdditionalDownloads($product, $additionalDownloadsInformation);


}