<?php
 
namespace Items\ItemInformation\Model;
 
use Items\ItemInformation\Api\AdditionalDownloadsRepositoryInterface;
use Items\ItemInformation\Api\Data\AdditionalDownloadsInterface;
use Items\ItemInformation\Model\AdditionalDownloadsFactory;
use Items\ItemInformation\Model\ResourceModel\AdditionalDownloads\Collection;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

class AdditionalDownloadsRepository implements \Items\ItemInformation\Api\AdditionalDownloadsRepositoryInterface
{
    /**
     * @var AdditionalDownloadsFactory
     */
    private $_additionalDownloadsFactory;
 
    public function __construct(
        \Items\ItemInformation\Model\AdditionalDownloadsFactory $additionalDownloadsFactory
    ) {
        $this->_additionalDownloadsFactory = $additionalDownloadsFactory;
    }
 
    public function getByProductId($productId)
    {
        $additionalDownloads = $this->_additionalDownloadsFactory->create();
        $additionalDownloads->getResource()->load($additionalDownloads, $productId);
        if (!$additionalDownloads->getItemId()) { 
           throw new NoSuchEntityException(__('Unable to find additional fownloads with ID "%1"', $productId));
        }
        return $additionalDownloads;
    }
     
    public function save(AdditionalDownloadsInterface $additionalDownloads)
    {
        try{
            $additionalDownloads->getResource()->save($additionalDownloads);
             return $additionalDownloads;
        } catch (\Exception $error){
            throw new CouldNotSaveException(__('The additional fownloads was unable to be saved. Error details: '.$error->getMessage()), $error);
        }
        
    }
     
    public function delete(AdditionalDownloadsInterface $additionalDownloads)
    {
        try {
            $additionalDownloads->getResource()->delete($additionalDownloads);
        } catch (\Exception $error){
            throw new CouldNotDeleteException(__('The additional fownloads was unable to be deleted. Error details: '.$error->getMessage()),
                $error
            );
        }
    }
}