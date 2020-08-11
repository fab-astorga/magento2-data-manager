<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Items\ItemInformation\Model\ResourceModel\Prices;

use Items\ItemInformation\Api\Data\PricesInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\EntityManager\MetadataPool;

class PricesLink
{
    /*****  TABLES ******/

    /** USA **/
    const NET_PRICE_USA = 'item_net_price_usa';
    const EQP_USA = 'item_eqp_usa';
    const PROMOTION_USA = 'item_promotion_usa';
    const RETAIL_PRICE_USA = 'item_retail_price_usa';
    const SALE_PRICE_USA = 'item_sale_price_usa';
    const SALE_PRICE_ONLINE_USA = 'item_sale_price_online_usa';
    const SAMPLE_PRICE_USA = 'item_sample_price_usa';
    const ONLINE_PRICE_USA = 'item_online_price_usa';

    /** CANADA **/
    const NET_PRICE_CANADA = 'item_net_price_canada';
    const EQP_CANADA = 'item_eqp_canada';
    const PROMOTION_CANADA = 'item_promotion_canada';
    const RETAIL_PRICE_CANADA = 'item_retail_price_canada';
    const SALE_PRICE_CANADA = 'item_sale_price_canada';
    const SALE_PRICE_ONLINE_CANADA = 'item_sale_price_online_canada';
    const SAMPLE_PRICE_CANADA = 'item_sample_price_canada';
    const ONLINE_PRICE_CANADA = 'item_online_price_canada';




    /**
     * @var \Magento\Framework\App\ResourceConnection
     */
    private $resourceConnection;

    /**
     * Link constructor.
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(
        ResourceConnection $resourceConnection
    ) {
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * @param int $productId
     * @return array
     */
    public function getPricesByProductdId($productId, $priceTable)
    {
        $connection = $this->resourceConnection->getConnection();

        $select = $connection->select()->from(
            $this->getItemPriceTable($priceTable),
            ['min_quantity','unit_price']
        )->where(
            'item_id = ?',
            (int) $productId
        );

        return $connection->fetchAll($select);
    }

    /**
     * @param int $productId
     * @param array $pricesTable
     * @return boolean
     */
    public function deletePrices($productId, $pricesTable)
    {
        $connection = $this->resourceConnection->getConnection();
        $sql = "DELETE  FROM $pricesTable WHERE item_id=$productId";         
        return $connection->query($sql);
    }

    /**
     * @param int $productId
     * @param array $prices
     * @param string $priceType
     * @return bool
     */
    public function savePrices(int $productId, array $prices, $priceTable)
    {
        $connection = $this->resourceConnection->getConnection();

        // Update Prices, Delete First
        $condition = ['item_id = ?' => (int) $productId];
        $connection->delete($this->getItemPriceTable($priceTable), $condition);
        
        if (!empty($prices)) {
            $data = [];
            foreach ($prices as $price) {
                $data[] = ['item_id' => (int) $productId, 'min_quantity' => (int) $price->getMinQuantity(), 'unit_price' => (float) $price->getUnitPrice()];
            }
            $connection->insertMultiple($this->getItemPriceTable($priceTable), $data);
        }

        return true;
    }

    /**
     * @return string
     */
    private function getItemPriceTable($priceTable)
    {
        return $this->resourceConnection->getTableName($priceTable);
    }
}
