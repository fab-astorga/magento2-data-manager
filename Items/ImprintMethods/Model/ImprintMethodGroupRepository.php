<?php

namespace Items\ImprintMethods\Model;

use Exception;
use Items\ImprintMethods\Api\Data\ImprintMethodGroupInterface;
use Items\ImprintMethods\Api\Data\ImprintMethodGroupSearchResultsInterface;
use Items\ImprintMethods\Api\Data\ImprintMethodGroupSearchResultsInterfaceFactory;
use Items\ImprintMethods\Api\ImprintMethodsGroupRepositoryInterface;
use Items\ImprintMethods\Model\ImprintMethodGroupFactory;
use Items\ImprintMethods\Model\ResourceModel\ImprintMethodGroup as ResourceModelImprintMethodGroup;
use Items\ImprintMethods\Model\ResourceModel\ImprintMethodGroup\Collection;
use Items\ImprintMethods\Model\ResourceModel\ImprintMethodGroup\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class ImprintMethodGroupRepository
 */
class ImprintMethodGroupRepository implements ImprintMethodsGroupRepositoryInterface
{

    /**
     * @var ImprintMethodGroupFactory
     */
    private $_imprintMethodGroupFactory;

    /**
     * @var ResourceModelImprintMethodGroup
     */
    private $_resourceModelImprintMethodGroup;

    /**
     * @var CollectionFactory
     */
    private $_imprintMethodGroupCollectionFactory;

    /**
     * @var ImprintMethodGroupSearchResultsInterfaceFactory
     */
    private $_imprintMethodGroupSearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    protected $_logger;
    /**
     * CustomerImprintMethodGroupRepository constructor.
     *
     * @param ImprintMethodGroupFactory $imprintMethodGroupFactory
     * @param ResourceModelImprintMethodGroup $resourceModelImprintMethodGroup
     * @param CollectionFactory $imprintMethodGroupCollectionFactory
     * @param ImprintMethodGroupSearchResultsInterfaceFactory $imprintMethodGroupSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        ImprintMethodGroupFactory $imprintMethodGroupFactory,
        ResourceModelImprintMethodGroup $resourceModelImprintMethodGroup,
        CollectionFactory $imprintMethodGroupCollectionFactory,
        ImprintMethodGroupSearchResultsInterfaceFactory $imprintMethodGroupSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        \File\CustomLog\Logger\Logger $logger
    ) {
        $this->_imprintMethodGroupFactory                       = $imprintMethodGroupFactory;
        $this->_resourceModelImprintMethodGroup                 = $resourceModelImprintMethodGroup;
        $this->_imprintMethodGroupCollectionFactory             = $imprintMethodGroupCollectionFactory;
        $this->_imprintMethodGroupSearchResultsInterfaceFactory = $imprintMethodGroupSearchResultsInterfaceFactory;
        $this->_collectionProcessor                  = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor     = $extensionAttributesJoinProcessor;
        $this->_logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function save(        
        $netsuiteId,
        $name
    )
    {
        $imprintMethodGroup = $this->_imprintMethodGroupFactory->create();        
        $imprintMethodGroup->setNetsuiteId($netsuiteId);    
        $imprintMethodGroup->setName($name);    
        $this->_resourceModelImprintMethodGroup->save($imprintMethodGroup);
        return $imprintMethodGroup;
    }

    /**
     * @inheritdoc
     */
    public function getById($netsuiteId)
    {
        $imprintMethodGroup = $this->get($netsuiteId, null);
        return $imprintMethodGroup;
    }

    /**
     * @inheritdoc
     */
    public function get($value, $attributeCode)
    {
        /** @var CustomerImprintMethodGroup $CustomerImprintMethodGroup */
        $imprintMethodGroup = $this->_imprintMethodGroupFactory->create()->load($value, $attributeCode);

        if (!$imprintMethodGroup->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity'));
        }
        
        return $imprintMethodGroup;
    }

    /**
     * @inheritdoc
     */
    public function delete(ImprintMethodGroupInterface $imprintMethodGroup)
    {
        $imprintMethodGroupId = $imprintMethodGroup->getId();

        try {
            $this->_resourceModelImprintMethodGroup->delete($imprintMethodGroup);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(
                __('Unable to remove entity %1', $imprintMethodGroupId)
            );
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById($netsuiteId)
    {
        $imprintMethodGroupId = $this->getById($netsuiteId);
        return $this->delete($imprintMethodGroupId);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->_imprintMethodGroupCollectionFactory->create();
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var ImprintMethodGroupSearchResultsInterface $searchResults */
        $searchResults = $this->_imprintMethodGroupSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}