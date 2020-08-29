<?php
 
namespace Items\ItemInformation\Api;
 
use Magento\Framework\Api\SearchCriteriaInterface;
use Items\ItemInformation\Api\Data\ItemMainShotsInterface;
 
interface ItemMainShotsRepositoryInterface
{
    /**
     * @param int $producId
     * @return \Items\ItemInformation\Api\Data\ItemMainShotsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getByProductId($producId);
    
    /**
     * @param \Items\ItemInformation\Api\Data\ItemMainShotsInterface $itemMainShots
     * @return \Items\ItemInformation\Api\Data\ItemMainShotsInterface
     */
    public function save(ItemMainShotsInterface $itemMainShots);
    
    /**
     * @param \Items\ItemInformation\Api\Data\ItemMainShotsInterface $itemMainShots
     * @return void
     */
    public function delete(ItemMainShotsInterface $itemMainShots);
}

