<?php
namespace Items\ItemInformation\Api;

interface WebStoreConfigurationManagementInterface {
 
    /**
     * Returns true if the web store configuration saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $webStoreInformation
     * @return boolean
     */
    public function saveWebStoreConfiguration($product, $webStoreInformation);


    /**
     * Returns true if the web store configuration saved correctly to product.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param \Items\ItemInformation\Api\Data\WebStoreConfigurationInterface $webStoreConfiguration
     * @return boolean
     */
    public function addWebStoreConfigurationToProduct($product, $webStoreInformation);

}