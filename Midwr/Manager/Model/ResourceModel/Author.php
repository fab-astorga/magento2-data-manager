<?php

namespace Midwr\Manager\Model\ResourceModel;

class Author extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('author_t', 'author_id');
    }
}