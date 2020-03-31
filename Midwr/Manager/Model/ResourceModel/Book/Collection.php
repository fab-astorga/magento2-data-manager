<?php
namespace Midwr\Manager\Model\ResourceModel\Book;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Midwr\Manager\Model\Book',
            'Midwr\Manager\Model\ResourceModel\Book'
        );
    }
}