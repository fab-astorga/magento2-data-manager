<?php

namespace HotChocolate\Manager\Model\ResourceModel\HotChocolate;

use HotChocolate\Manager\Model\HotChocolate as ModelHotChocolate;
use HotChocolate\Manager\Model\ResourceModel\HotChocolate as ResourceModelHotChocolate;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * Initialize resource model collection
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ModelHotChocolate::class, ResourceModelHotChocolate::class);
    }
}