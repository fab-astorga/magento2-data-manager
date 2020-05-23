<?php

namespace Services\HotChocolate\Model\ResourceModel\HotChocolate;

use Services\HotChocolate\Model\HotChocolate as ModelHotChocolate;
use Services\HotChocolate\Model\ResourceModel\HotChocolate as ResourceModelHotChocolate;
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