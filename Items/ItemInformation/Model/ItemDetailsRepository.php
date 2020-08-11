<?php
 
namespace Items\ItemInformation\Model;
 
use Items\ItemInformation\Api\ItemDetailsRepositoryInterface;
use Items\ItemInformation\Api\Data\ItemDetailsInterface;
use Items\ItemInformation\Model\ItemDetailsFactory;
use Items\ItemInformation\Model\ResourceModel\ItemDetails\Collection;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

class ItemDetailsRepository implements \Items\ItemInformation\Api\ItemDetailsRepositoryInterface
{
    /**
     * @var ItemDetailsFactory
     */
    private $_itemDetailsFactory;
 
    public function __construct(
        \Items\ItemInformation\Model\ItemDetailsFactory $itemDetailsFactory
    ) {
        $this->_itemDetailsFactory = $itemDetailsFactory;
    }
 
    public function getByProductId($productId)
    {
        $itemDetails = $this->_itemDetailsFactory->create();
        $itemDetails->getResource()->load($itemDetails, $productId);
        if (!$itemDetails->getItemId()) { 
           throw new NoSuchEntityException(__('Unable to find item details with ID "%1"', $productId));
        }
        return $itemDetails;
    }
     
    public function save(ItemDetailsInterface $itemDetails)
    {
        try{
            $itemDetails->getResource()->save($itemDetails);
             return $itemDetails;
        } catch (\Exception $error){
            throw new CouldNotSaveException(__('The item details was unable to be saved. Error details: '.$error->getMessage()), $error);
        }
        
    }
     
    public function delete(ItemDetailsInterface $itemDetails)
    {
        try {
            $itemDetails->getResource()->delete($itemDetails);
        } catch (\Exception $error){
            throw new CouldNotDeleteException(__('The item details was unable to be deleted. Error details: '.$error->getMessage()),
                $error
            );
        }
    }
}