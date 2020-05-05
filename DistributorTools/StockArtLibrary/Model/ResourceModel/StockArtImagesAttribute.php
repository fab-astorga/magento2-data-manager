<?php
namespace DistributorTools\StockArtLibrary\Model\ResourceModel;

class StockArtImagesAttribute extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $_isPkAutoIncrement = false;

    protected function _construct()
    {
        $this->_init('stock_art_images', 'id');
    }
}