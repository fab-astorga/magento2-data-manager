<?php
 
namespace Items\ItemInformation\Model;
 
use Items\ItemInformation\Api\SafetyDetailsRepositoryInterface;
use Items\ItemInformation\Api\Data\SafetyDetailsInterface;
use Items\ItemInformation\Model\SafetyDetailsFactory;
use Items\ItemInformation\Model\ResourceModel\SafetyDetails\Collection;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

class SafetyDetailsRepository implements \Items\ItemInformation\Api\SafetyDetailsRepositoryInterface
{
    /**
     * @var SafetyDetailsFactory
     */
    private $safetyDetailsFactory;
 
    public function __construct(
        \Items\ItemInformation\Model\SafetyDetailsFactory $safetyDetailsFactory
    ) {
        $this->safetyDetailsFactory = $safetyDetailsFactory;
    }
 
    public function getByProductId($productId)
    {
        $safetyDetails = $this->safetyDetailsFactory->create();
        $safetyDetails->getResource()->load($safetyDetails, $productId);
        if (!$safetyDetails->getItemId()) { 
           throw new NoSuchEntityException(__('Unable to find safety details with ID "%1"', $productId));
        }
        return $safetyDetails;
    }
     
    public function save(SafetyDetailsInterface $safetyDetails)
    {
        try{
            $safetyDetails->getResource()->save($safetyDetails);
             return $safetyDetails;
        } catch (\Exception $error){
            throw new CouldNotSaveException(__('The safety details was unable to be saved. Error details: '.$error->getMessage()), $error);
        }
        
    }
     
    public function delete(SafetyDetailsInterface $safetyDetails)
    {
        try {
            $safetyDetails->getResource()->delete($safetyDetails);
        } catch (\Exception $error){
            throw new CouldNotDeleteException(__('The safety details was unable to be deleted. Error details: '.$error->getMessage()),
                $error
            );
        }
    }
}