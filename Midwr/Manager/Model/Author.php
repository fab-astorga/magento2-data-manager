<?php

namespace Midwr\Manager\Model;

use \Magento\Framework\Model\AbstractModel;

class Author extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Midwr\Manager\Model\ResourceModel\Author');
    }
}