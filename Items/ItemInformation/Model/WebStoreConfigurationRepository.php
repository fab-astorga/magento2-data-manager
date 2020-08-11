<?php
 
namespace Items\ItemInformation\Model;
 
use Items\ItemInformation\Api\WebStoreConfigurationRepositoryInterface;
use Items\ItemInformation\Api\Data\WebStoreConfigurationInterface;
use Items\ItemInformation\Model\WebStoreConfigurationFactory;
use Items\ItemInformation\Model\ResourceModel\WebStoreConfiguration\Collection;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

class WebStoreConfigurationRepository implements \Items\ItemInformation\Api\WebStoreConfigurationRepositoryInterface
{
    /**
     * @var WebStoreConfigurationFactory
     */
    private $webStoreConfigurationFactory;
 
    public function __construct(
        \Items\ItemInformation\Model\WebStoreConfigurationFactory $webStoreConfigurationFactory
    ) {
        $this->webStoreConfigurationFactory = $webStoreConfigurationFactory;
    }
 
    public function getByProductId($productId)
    {
        $webStoreConfiguration = $this->webStoreConfigurationFactory->create();
        $webStoreConfiguration->getResource()->load($webStoreConfiguration, $productId);
        if (!$webStoreConfiguration->getItemId()) { 
           throw new NoSuchEntityException(__('Unable to find imprint shipping details with ID "%1"', $productId));
        }
        return $webStoreConfiguration;
    }
     
    public function save(WebStoreConfigurationInterface $webStoreConfiguration)
    {
        try{
            $webStoreConfiguration->getResource()->save($webStoreConfiguration);
             return $webStoreConfiguration;
        } catch (\Exception $error){
            throw new CouldNotSaveException(__('The shipping details was unable to be saved. Error details: '.$error->getMessage()), $error);
        }
        
    }
     
    public function delete(WebStoreConfigurationInterface $webStoreConfiguration)
    {
        try {
            $webStoreConfiguration->getResource()->delete($webStoreConfiguration);
        } catch (\Exception $error){
            throw new CouldNotDeleteException(__('The shipping details was unable to be deleted. Error details: '.$error->getMessage()),
                $error
            );
        }
    }
}