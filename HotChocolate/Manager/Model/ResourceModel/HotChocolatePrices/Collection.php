<?php

namespace HotChocolate\Manager\Model\ResourceModel\HotChocolatePrices;

use HotChocolate\Manager\Model\HotChocolatePrices as ModelHotChocolatePrices;
use HotChocolate\Manager\Model\ResourceModel\HotChocolatePrices as ResourceModelHotChocolatePrices;
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
        $this->_init(ModelHotChocolatePrices::class, ResourceModelHotChocolatePrices::class);
    }
}