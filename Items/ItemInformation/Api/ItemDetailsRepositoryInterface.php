<?php
 
namespace Items\ItemInformation\Api;
 
use Magento\Framework\Api\SearchCriteriaInterface;
use Items\ItemInformation\Api\Data\ItemDetailsInterface;
 
interface ItemDetailsRepositoryInterface
{
    /**
     * @param int $producId
     * @return \Items\ItemInformation\Api\Data\ItemDetailsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getByProductId($producId);
    
    /**
     * @param \Items\ItemInformation\Api\Data\ItemDetailsInterface $itemDetails
     * @return \Items\ItemInformation\Api\Data\ItemDetailsInterface
     */
    public function save(ItemDetailsInterface $ItemDetails);
    
    /**
     * @param \Items\ItemInformation\Api\Data\ItemDetailsInterface $itemDetails
     * @return void
     */
    public function delete(ItemDetailsInterface $ItemDetails);
}

