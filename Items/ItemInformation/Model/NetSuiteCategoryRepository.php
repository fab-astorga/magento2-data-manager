<?php
 
namespace Items\ItemInformation\Model;
 
use Items\ItemInformation\Api\NetSuiteCategoryRepositoryInterface;
use Items\ItemInformation\Api\Data\NetSuiteCategoryInterface;
use Items\ItemInformation\Model\NetSuiteCategoryFactory;
use Items\ItemInformation\Model\ResourceModel\NetSuiteCategory\Collection;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

class NetSuiteCategoryRepository implements \Items\ItemInformation\Api\NetSuiteCategoryRepositoryInterface
{
    /**
     * @var NetSuiteCategoryFactory
     */
    private $_netSuiteCategoryFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;
 
    public function __construct(
        \Items\ItemInformation\Model\NetSuiteCategoryFactory $netSuiteCategoryFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->_netSuiteCategoryFactory = $netSuiteCategoryFactory;
        $this->_registry = $registry;
    }
 
    public function getByNetSuiteCategoryId($netsuiteCategoryId)
    {
        $netSuiteCategory = $this->_netSuiteCategoryFactory->create();
        $netSuiteCategory->getResource()->load($netSuiteCategory, $netsuiteCategoryId);
        if (!$netSuiteCategory->getNetSuiteCategoryId()) { 
           throw new NoSuchEntityException(__('Unable to find NetSuite category with ID "%1"', $netsuiteCategoryId));
        }
        return $netSuiteCategory;
    }
     
    public function save(NetSuiteCategoryInterface $netSuiteCategory)
    {
        try{
            $netSuiteCategory->getResource()->save($netSuiteCategory);
             return $netSuiteCategory;
        } catch (\Exception $error){
            throw new CouldNotSaveException(__('The NetSuite category was unable to be saved. Error details: '.$error->getMessage()), $error);
        }
        
    }
     
    public function delete(NetSuiteCategoryInterface $netSuiteCategory)
    {
        try {
            $netSuiteCategory->getResource()->delete($netSuiteCategory);
        } catch (\Exception $error){
            throw new CouldNotDeleteException(__('The NetSuite category was unable to be deleted. Error details: '.$error->getMessage()),
                $error
            );
        }
    }

    public function getCurrentCategoryOb()
    {
        return $this->_registry->registry('current_category');
    }
}