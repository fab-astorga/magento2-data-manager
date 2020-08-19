<?php

namespace Items\ItemInformation\Api;

interface NonInventoryManagementInterface 
{
    /**
     * Create new non inventory item
     * 
     * @param int $netsuiteId
     * @param string $sku
     * @return \Magento\Catalog\Api\Data\ProductInterface
     */
    public function createNonInventoryItem($netsuiteId, $sku);
}