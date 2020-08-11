<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Items\ImprintMethods\Model\ResourceModel\ImprintMethodImage;

use Items\ImprintMethods\Api\Data\ImprintMethodInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\EntityManager\MetadataPool;

class ImprintMethodImageLink
{
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
     * Retrieve associated with product websites ids
     * @param int $imprintMethodId
     * @return array
     */
    public function getImagesByImprintMethodId($imprintMethodId)
    {
        $connection = $this->resourceConnection->getConnection();

        $select = $connection->select()->from(
            $this->getImprintMethodImageTable(),
            'imprint_method_image'
        )->where(
            'imprint_method_id = ?',
            (int) $imprintMethodId
        );

        return $connection->fetchCol($select);
    }

    /**
     * Return true - if websites was changed, and false - if not
     * @param ProductInterface $product
     * @param array $websiteIds
     * @return bool
     */
    public function saveImprintMethodImages(ImprintMethodInterface $imprintMethod, array $images)
    {
        $connection = $this->resourceConnection->getConnection();

        $oldImages = $this->getImagesByImprintMethodId($imprintMethod->getImprintMethodId());
        $insert = array_diff($images, $oldImages);
        $delete = array_diff($oldImages, $images);

        if (!empty($insert)) {
            $data = [];
            foreach ($insert as $image) {
                $data[] = ['imprint_method_id' => (int) $imprintMethod->getImprintMethodId(), 'imprint_method_image' => (string) $image];
            }
            $connection->insertMultiple($this->getImprintMethodImageTable(), $data);
        }

        if (!empty($delete)) {
            foreach ($delete as $image) {
                $condition = ['imprint_method_id = ?' => (int) $imprintMethod->getImprintMethodId(), 'imprint_method_image = ?' => (string) $image];
                $connection->delete($this->getImprintMethodImageTable(), $condition);
            }
        }

        if (!empty($insert) || !empty($delete)) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    private function getImprintMethodImageTable()
    {
        return $this->resourceConnection->getTableName('general_imprint_methods_image');
    }
}
