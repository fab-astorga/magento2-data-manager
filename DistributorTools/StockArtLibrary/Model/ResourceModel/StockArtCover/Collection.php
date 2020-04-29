<?php

namespace DistributorTools\StockArtLibrary\Model\ResourceModel\StockArtCover;

use DistributorTools\StockArtLibrary\Model\StockArtCover as ModelStockArtCover;
use DistributorTools\StockArtLibrary\Model\ResourceModel\StockArtCover as ResourceModelStockArtCover;
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
        $this->_init(ModelStockArtCover::class, ResourceModelStockArtCover::class);
    }
}