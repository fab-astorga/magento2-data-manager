<?php
namespace Midwr\Manager\Model\ResourceModel\Author;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Midwr\Manager\Model\Author',
            'Midwr\Manager\Model\ResourceModel\Author'
        );
    }
}