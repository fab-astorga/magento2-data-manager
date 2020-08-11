<?php
 
namespace Items\ItemInformation\Api;
 
use Magento\Framework\Api\SearchCriteriaInterface;
use Items\ItemInformation\Api\Data\ShippingDetailsInterface;
 
interface ShippingDetailsRepositoryInterface
{
    /**
     * @param int $producId
     * @return \Items\ItemInformation\Api\Data\ShippingDetailsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getByProductId($producId);
    
    /**
     * @param \Items\ItemInformation\Api\Data\ShippingDetailsInterface $imprintMethod
     * @return \Items\ItemInformation\Api\Data\ShippingDetailsInterface
     */
    public function save(ShippingDetailsInterface $shippingDetails);
    
    /**
     * @param \Items\ItemInformation\Api\Data\ShippingDetailsInterface $imprintMethod
     * @return void
     */
    public function delete(ShippingDetailsInterface $shippingDetails);
}

