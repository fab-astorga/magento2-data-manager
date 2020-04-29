<?php

namespace DistributorTools\StockArtLibrary\Model\ResourceModel;

use DistributorTools\StockArtLibrary\Api\Data\StockArtCoverInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class StockArtCover
 */
class StockArtCover extends AbstractDb
{
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(StockArtCoverInterface::TABLE, StockArtCoverInterface::ID);
    }
}