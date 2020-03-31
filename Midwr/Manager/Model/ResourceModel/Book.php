<?php

namespace Midwr\Manager\Model\ResourceModel;

class Book extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('book_t', 'book_id');
    }
}