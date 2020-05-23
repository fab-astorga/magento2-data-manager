<?php

namespace Services\HotChocolate\Model\ResourceModel\HotChocolatePrices;

use Services\HotChocolate\Model\HotChocolatePrices as ModelHotChocolatePrices;
use Services\HotChocolate\Model\ResourceModel\HotChocolatePrices as ResourceModelHotChocolatePrices;
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