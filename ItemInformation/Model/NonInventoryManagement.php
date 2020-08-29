<?php

namespace Items\ItemInformation\Model;

class NonInventoryManagement implements \Items\ItemInformation\Api\NonInventoryManagementInterface 
{    
    protected $_logger; 

    public function __construct(
        \File\CustomLog\Logger\Logger $logger
    )
    {
        $this->_logger = $logger;
    }

    /**
     * Create new non inventory item
     * 
     * @param int $netsuiteId
     * @param string $sku
     * @return \Magento\Catalog\Api\Data\ProductInterface
     */
    public function createNonInventoryItem($netsuiteId, $sku)
    {
        $this->_logger->info('NON INVENTORY: ' .$sku);
    }

}