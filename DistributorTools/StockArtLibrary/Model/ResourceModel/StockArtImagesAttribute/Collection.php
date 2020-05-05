<?php
namespace DistributorTools\StockArtLibrary\Model\ResourceModel\StockArtImagesAttribute;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('DistributorTools\StockArtLibrary\Model\StockArtImagesAttribute', 
                        'DistributorTools\StockArtLibrary\Model\ResourceModel\StockArtImagesAttribute');
    }
}