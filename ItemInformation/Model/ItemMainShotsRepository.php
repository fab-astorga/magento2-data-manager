<?php
 
namespace Items\ItemInformation\Model;
 
use Items\ItemInformation\Api\ItemMainShotsRepositoryInterface;
use Items\ItemInformation\Api\Data\ItemMainShotsInterface;
use Items\ItemInformation\Model\ItemMainShotsFactory;
use Items\ItemInformation\Model\ResourceModel\ItemMainShots\Collection;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

class ItemMainShotsRepository implements \Items\ItemInformation\Api\ItemMainShotsRepositoryInterface
{
    /**
     * @var ItemMainShotsFactory
     */
    private $_itemMainShotsFactory;
 
    public function __construct(
        \Items\ItemInformation\Model\ItemMainShotsFactory $itemMainShotsFactory
    ) {
        $this->_itemMainShotsFactory = $itemMainShotsFactory;
    }
 
    public function getByProductId($productId)
    {
        $itemMainShots = $this->_itemMainShotsFactory->create();
        $itemMainShots->getResource()->load($itemMainShots, $productId);
        if (!$itemMainShots->getItemId()) { 
           throw new NoSuchEntityException(__('Unable to find item main shots with ID "%1"', $productId));
        }
        return $itemMainShots;
    }
     
    public function save(ItemMainShotsInterface $itemMainShots)
    {
        try{
            $itemMainShots->getResource()->save($itemMainShots);
             return $itemMainShots;
        } catch (\Exception $error){
            throw new CouldNotSaveException(__('The item main shots was unable to be saved. Error details: '.$error->getMessage()), $error);
        }
        
    }
     
    public function delete(ItemMainShotsInterface $itemMainShots)
    {
        try {
            $itemMainShots->getResource()->delete($itemMainShots);
        } catch (\Exception $error){
            throw new CouldNotDeleteException(__('The item main shots was unable to be deleted. Error details: '.$error->getMessage()),
                $error
            );
        }
    }
}