<?php

namespace Items\ItemInformation\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Items\ItemInformation\Api\Data\NetSuiteCategoryInterface;

interface NetSuiteCategoryRepositoryInterface
{
    /**
     * @param int $netsuiteId
     * @return \Items\ItemInformation\Api\Data\NetSuiteCategoryInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getByNetSuiteCategoryId($netsuiteId);
    
    /**
     * @param \Items\ItemInformation\Api\Data\NetSuiteCategoryInterface $netsuiteCategory
     * @return \Items\ItemInformation\Api\Data\NetSuiteCategoryInterface
     */
    public function save(NetSuiteCategoryInterface $netsuiteCategory);
    
    /**
     * @param \Items\ItemInformation\Api\Data\NetSuiteCategoryInterface $netsuiteCategory
     * @return void
     */
    public function delete(NetSuiteCategoryInterface $netsuiteCategory);

    /**
     * Return catalog current category object
     * @return \Magento\Catalog\Model\Category
     */
    public function getCurrentCategoryOb();
}