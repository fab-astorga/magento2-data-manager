<?php
 
namespace Items\ItemInformation\Api;
 
use Magento\Framework\Api\SearchCriteriaInterface;
use Items\ItemInformation\Api\Data\AdditionalDownloadsInterface;
 
interface AdditionalDownloadsRepositoryInterface
{
    /**
     * @param int $producId
     * @return \Items\ItemInformation\Api\Data\AdditionalDownloadsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getByProductId($producId);
    
    /**
     * @param \Items\ItemInformation\Api\Data\AdditionalDownloadsInterface $additionalDownloads
     * @return \Items\ItemInformation\Api\Data\AdditionalDownloadsInterface
     */
    public function save(AdditionalDownloadsInterface $additionalDownloads);
    
    /**
     * @param \Items\ItemInformation\Api\Data\AdditionalDownloadsInterface $additionalDownloads
     * @return void
     */
    public function delete(AdditionalDownloadsInterface $additionalDownloads);
}

