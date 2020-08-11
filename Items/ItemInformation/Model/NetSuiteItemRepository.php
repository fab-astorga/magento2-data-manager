<?php
 
namespace Items\ItemInformation\Model;
 
use Items\ItemInformation\Api\NetSuiteItemRepositoryInterface;
use Items\ItemInformation\Api\Data\NetSuiteItemInterface;
use Items\ItemInformation\Model\NetSuiteItemFactory;
use Items\ItemInformation\Model\ResourceModel\NetSuiteItem\Collection;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

class NetSuiteItemRepository implements \Items\ItemInformation\Api\NetSuiteItemRepositoryInterface
{
    /**
     * @var NetSuiteItemFactory
     */
    private $_netSuiteItemFactory;
 
    public function __construct(
        \Items\ItemInformation\Model\NetSuiteItemFactory $netSuiteItemFactory
    ) {
        $this->_netSuiteItemFactory = $netSuiteItemFactory;
    }
 
    public function getByNetSuiteItemId($netsuiteItemId)
    {
        $netSuiteItem = $this->_netSuiteItemFactory->create();
        $netSuiteItem->getResource()->load($netSuiteItem, $netsuiteItemId);
        if (!$netSuiteItem->getNetSuiteItemId()) { 
           throw new NoSuchEntityException(__('Unable to find NetSuite item with ID "%1"', $netsuiteItemId));
        }
        return $netSuiteItem;
    }
     
    public function save(NetSuiteItemInterface $netSuiteItem)
    {
        try{
            $netSuiteItem->getResource()->save($netSuiteItem);
             return $netSuiteItem;
        } catch (\Exception $error){
            throw new CouldNotSaveException(__('The NetSuite item was unable to be saved. Error details: '.$error->getMessage()), $error);
        }
        
    }
     
    public function delete(NetSuiteItemInterface $netSuiteItem)
    {
        try {
            $netSuiteItem->getResource()->delete($netSuiteItem);
        } catch (\Exception $error){
            throw new CouldNotDeleteException(__('The NetSuite item was unable to be deleted. Error details: '.$error->getMessage()),
                $error
            );
        }
    }
}