<?php
 
namespace Items\ItemInformation\Api;
 
use Magento\Framework\Api\SearchCriteriaInterface;
use Items\ItemInformation\Api\Data\NetSuiteItemInterface;
 
interface NetSuiteItemRepositoryInterface
{
    /**
     * @param int $netsuiteId
     * @return \Items\ItemInformation\Api\Data\NetSuiteItemInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getByNetSuiteItemId($netsuiteId);

    /**
     * Retrieve netsuite item by attribute and value
     *
     * @param $value
     * @param string|null $attributeCode
     * @return \Customer\Company\Api\Data\NetSuiteItemInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($value, $attributeCode);
    
    /**
     * @param \Items\ItemInformation\Api\Data\NetSuiteItemInterface $netsuiteItem
     * @return \Items\ItemInformation\Api\Data\NetSuiteItemInterface
     */
    public function save(NetSuiteItemInterface $netsuiteItem);
    
    /**
     * @param \Items\ItemInformation\Api\Data\NetSuiteItemInterface $netsuiteItem
     * @return void
     */
    public function delete(NetSuiteItemInterface $netsuiteItem);
}

