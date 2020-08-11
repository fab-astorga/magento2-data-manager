<?php

namespace Items\ImprintMethods\Model;

use Exception;
use Items\ImprintMethods\Api\Data\ImprintMethodInterface;
use Items\ImprintMethods\Api\Data\ImprintMethodSearchResultsInterface;
use Items\ImprintMethods\Api\Data\ImprintMethodSearchResultsInterfaceFactory;
use Items\ImprintMethods\Api\ImprintMethodsRepositoryInterface;
use Items\ImprintMethods\Model\ImprintMethodFactory;
use Items\ImprintMethods\Model\ResourceModel\ImprintMethod as ResourceModelImprintMethod;
use Items\ImprintMethods\Model\ResourceModel\ImprintMethod\Collection;
use Items\ImprintMethods\Model\ResourceModel\ImprintMethod\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class ImprintMethodRepository
 */
class ImprintMethodsRepository implements ImprintMethodsRepositoryInterface
{

    /**
     * @var ImprintMethodFactory
     */
    private $_imprintMethodFactory;

    /**
     * @var ResourceModelImprintMethod
     */
    private $_resourceModelImprintMethod;

    /**
     * @var CollectionFactory
     */
    private $_imprintMethodCollectionFactory;

    /**
     * @var ImprintMethodSearchResultsInterfaceFactory
     */
    private $_imprintMethodSearchResultsInterfaceFactory;

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
     * ImprintMethodRepository constructor.
     *
     * @param ImprintMethodFactory $imprintMethodFactory
     * @param ResourceModelImprintMethod $resourceModelImprintMethod
     * @param CollectionFactory $imprintMethodCollectionFactory
     * @param ImprintMethodSearchResultsInterfaceFactory $imprintMethodSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        ImprintMethodFactory $imprintMethodFactory,
        ResourceModelImprintMethod $resourceModelImprintMethod,
        CollectionFactory $imprintMethodCollectionFactory,
        ImprintMethodSearchResultsInterfaceFactory $imprintMethodSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        \File\CustomLog\Logger\Logger $logger
    ) {
        $this->_imprintMethodFactory                       = $imprintMethodFactory;
        $this->_resourceModelImprintMethod                 = $resourceModelImprintMethod;
        $this->_imprintMethodCollectionFactory             = $imprintMethodCollectionFactory;
        $this->_imprintMethodSearchResultsInterfaceFactory = $imprintMethodSearchResultsInterfaceFactory;
        $this->_collectionProcessor                  = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor     = $extensionAttributesJoinProcessor;
        $this->_logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function save(
        $netsuiteId, 
        $imcGroupId, 
        $imcSetupItemId, 
        $imcFirstRunItemId, 
        $imcAddRunItemId,                        
        $imcResetUpItemId, 
        $imcExactPlacItemId, 
        $imcPmsOnlineItemId, 
        $imcInkChangeItemId,
        $imcLtmItemId, 
        $imcLocationName, 
        $imprintWidth, 
        $imprintHeight
    )
    {
        $imprintMethod = $this->_imprintMethodFactory->create();        
        $imprintMethod->setNetsuiteId($netsuiteId);
        $imprintMethod->setImcGroupId($imcGroupId);
        $imprintMethod->setImcSetupItemId($imcSetupItemId);
        $imprintMethod->setImcFirstRunItemId($imcFirstRunItemId);
        $imprintMethod->setImcAddRunItemId($imcAddRunItemId);
        $imprintMethod->setImcResetUpItemId($imcResetUpItemId);
        $imprintMethod->setImcExactPlacItemId($imcExactPlacItemId);
        $imprintMethod->setImcPmsOnlineItemId($imcPmsOnlineItemId);
        $imprintMethod->setImcInkChangeItemId($imcInkChangeItemId);
        $imprintMethod->setImcLtmItemId($imcLtmItemId);
        $imprintMethod->setImcLocationName($imcLocationName);
        $imprintMethod->setImprintWidth($imprintWidth);
        $imprintMethod->setImprintHeight($imprintHeight);
        $this->_resourceModelImprintMethod->save($imprintMethod);
        return $imprintMethod;
    }

    /**
     * @inheritdoc
     */
    public function getById($netsuiteId)
    {
        $imprintMethod = $this->get($netsuiteId, null);
        return $imprintMethod;
    }

    /**
     * @inheritdoc
     */
    public function get($value, $attributeCode)
    {        
        $imprintMethod = $this->_imprintMethodFactory->create()->load($value, $attributeCode);

        if (!$imprintMethod->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity'));
        }
        
        return $imprintMethod;
    }

    /**
     * @inheritdoc
     */
    public function delete(ImprintMethodInterface $imprintMethod)
    {
        $imprintMethodId = $imprintMethod->getId();

        try {
            $this->_resourceModelImprintMethod->delete($imprintMethod);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(
                __('Unable to remove entity %1', $imprintMethodId)
            );
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById($netsuiteId)
    {
        $imprintMethodId = $this->getById($netsuiteId);
        return $this->delete($imprintMethodId);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->_imprintMethodCollectionFactory->create();
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var ImprintMethodSearchResultsInterface $searchResults */
        $searchResults = $this->_imprintMethodSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}