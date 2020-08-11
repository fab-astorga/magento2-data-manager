<?php
 
namespace Items\ItemInformation\Api;
 
use Magento\Framework\Api\SearchCriteriaInterface;
use Items\ItemInformation\Api\Data\ItemMatrixShotsInterface;
 
interface ItemMatrixShotsRepositoryInterface
{
    /**
     * @param int $producId
     * @return \Items\ItemInformation\Api\Data\ItemMatrixShotsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getByProductId($producId);
    
    /**
     * @param \Items\ItemInformation\Api\Data\ItemMatrixShotsInterface $itemMatrixShots
     * @return \Items\ItemInformation\Api\Data\ItemMatrixShotsInterface
     */
    public function save(ItemMatrixShotsInterface $itemMatrixShots);
    
    /**
     * @param \Items\ItemInformation\Api\Data\ItemMatrixShotsInterface $itemMatrixShots
     * @return void
     */
    public function delete(ItemMatrixShotsInterface $itemMatrixShots);
}

