<?php
 
namespace Items\ItemInformation\Api;
 
use Magento\Framework\Api\SearchCriteriaInterface;
use Items\ItemInformation\Api\Data\WebStoreConfigurationInterface;
 
interface WebStoreConfigurationRepositoryInterface
{
    /**
     * @param int $producId
     * @return \Items\ItemInformation\Api\Data\WebStoreConfigurationInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getByProductId($producId);
    
    /**
     * @param \Items\ItemInformation\Api\Data\WebStoreConfigurationInterface $webStoreConfiguration
     * @return \Items\ItemInformation\Api\Data\WebStoreConfigurationInterface
     */
    public function save(WebStoreConfigurationInterface $shippinwebStoreConfigurationgDetails);
    
    /**
     * @param \Items\ItemInformation\Api\Data\WebStoreConfigurationInterface $webStoreConfiguration
     * @return void
     */
    public function delete(WebStoreConfigurationInterface $webStoreConfiguration);
}

