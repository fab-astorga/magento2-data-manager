<?php

namespace Midwr\Manager\Model;

use \Magento\Framework\Model\AbstractModel;

class Book extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Midwr\Manager\Model\ResourceModel\Book');
    }
}