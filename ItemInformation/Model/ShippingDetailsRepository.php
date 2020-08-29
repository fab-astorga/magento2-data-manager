<?php
 
namespace Items\ItemInformation\Model;
 
use Items\ItemInformation\Api\ShippingDetailsRepositoryInterface;
use Items\ItemInformation\Api\Data\ShippingDetailsInterface;
use Items\ItemInformation\Model\ShippingDetailsFactory;
use Items\ItemInformation\Model\ResourceModel\ShippingDetails\Collection;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

class ShippingDetailsRepository implements \Items\ItemInformation\Api\ShippingDetailsRepositoryInterface
{
    /**
     * @var ShippingDetailsFactory
     */
    private $shippingDetailsFactory;
 
    public function __construct(
        \Items\ItemInformation\Model\ShippingDetailsFactory $shippingDetailsFactory
    ) {
        $this->shippingDetailsFactory = $shippingDetailsFactory;
    }
 
    public function getByProductId($productId)
    {
        $shippingDetails = $this->shippingDetailsFactory->create();
        $shippingDetails->getResource()->load($shippingDetails, $productId);
        if (!$shippingDetails->getItemId()) { 
           throw new NoSuchEntityException(__('Unable to find imprint shipping details with ID "%1"', $productId));
        }
        return $shippingDetails;
    }
     
    public function save(ShippingDetailsInterface $shippingDetails)
    {
        try{
            $shippingDetails->getResource()->save($shippingDetails);
             return $shippingDetails;
        } catch (\Exception $error){
            throw new CouldNotSaveException(__('The shipping details was unable to be saved. Error details: '.$error->getMessage()), $error);
        }
        
    }
     
    public function delete(ShippingDetailsInterface $shippingDetails)
    {
        try {
            $shippingDetails->getResource()->delete($shippingDetails);
        } catch (\Exception $error){
            throw new CouldNotDeleteException(__('The shipping details was unable to be deleted. Error details: '.$error->getMessage()),
                $error
            );
        }
    }
}