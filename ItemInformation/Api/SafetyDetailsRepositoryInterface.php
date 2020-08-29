<?php
 
namespace Items\ItemInformation\Api;
 
use Magento\Framework\Api\SearchCriteriaInterface;
use Items\ItemInformation\Api\Data\SafetyDetailsInterface;
 
interface SafetyDetailsRepositoryInterface
{
    /**
     * @param int $producId
     * @return \Items\ItemInformation\Api\Data\SafetyDetailsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getByProductId($producId);
    
    /**
     * @param \Items\ItemInformation\Api\Data\SafetyDetailsInterface $safetyDetails
     * @return \Items\ItemInformation\Api\Data\SafetyDetailsInterface
     */
    public function save(SafetyDetailsInterface $safetyDetails);
    
    /**
     * @param \Items\ItemInformation\Api\Data\SafetyDetailsInterface $safetyDetails
     * @return void
     */
    public function delete(SafetyDetailsInterface $safetyDetails);
}

