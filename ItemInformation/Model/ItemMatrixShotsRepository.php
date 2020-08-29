<?php
 
namespace Items\ItemInformation\Model;
 
use Items\ItemInformation\Api\ItemMatrixShotsRepositoryInterface;
use Items\ItemInformation\Api\Data\ItemMatrixShotsInterface;
use Items\ItemInformation\Model\ItemMatrixShotsFactory;
use Items\ItemInformation\Model\ResourceModel\ItemMatrixShots\Collection;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

class ItemMatrixShotsRepository implements \Items\ItemInformation\Api\ItemMatrixShotsRepositoryInterface
{
    /**
     * @var ItemMatrixShotsFactory
     */
    private $_itemMatrixShotsFactory;
 
    public function __construct(
        \Items\ItemInformation\Model\ItemMatrixShotsFactory $itemMatrixShotsFactory
    ) {
        $this->_itemMatrixShotsFactory = $itemMatrixShotsFactory;
    }
 
    public function getByProductId($productId)
    {
        $itemMatrixShots = $this->_itemMatrixShotsFactory->create();
        $itemMatrixShots->getResource()->load($itemMatrixShots, $productId);
        if (!$itemMatrixShots->getItemId()) { 
           throw new NoSuchEntityException(__('Unable to find item matrix shots with ID "%1"', $productId));
        }
        return $itemMatrixShots;
    }
     
    public function save(ItemMatrixShotsInterface $itemMatrixShots)
    {
        try{
            $itemMatrixShots->getResource()->save($itemMatrixShots);
             return $itemMatrixShots;
        } catch (\Exception $error){
            throw new CouldNotSaveException(__('The item matrix shots was unable to be saved. Error details: '.$error->getMessage()), $error);
        }
        
    }
     
    public function delete(ItemMatrixShotsInterface $itemMatrixShots)
    {
        try {
            $itemMatrixShots->getResource()->delete($itemMatrixShots);
        } catch (\Exception $error){
            throw new CouldNotDeleteException(__('The item matrix shots was unable to be deleted. Error details: '.$error->getMessage()),
                $error
            );
        }
    }
}