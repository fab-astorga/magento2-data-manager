<?php

namespace Customers\Address\Model;

use Exception;
use Customers\Address\Api\Data\AddressDataInterface;
use Customers\Address\Api\Data\AddressDataSearchResultsInterface;
use Customers\Address\Api\Data\AddressDataSearchResultsInterfaceFactory;
use Customers\Address\Api\AddressDataRepositoryInterface;
use Customers\Address\Model\AddressDataFactory;
use Customers\Address\Model\ResourceModel\AddressData as ResourceModelAddressData;
use Customers\Address\Model\ResourceModel\AddressData\Collection;
use Customers\Address\Model\ResourceModel\AddressData\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class AddressDataRepository
 */
class AddressDataRepository implements AddressDataRepositoryInterface
{

    /**
     * @var AddressDataFactory
     */
    private $_addressDataFactory;

    /**
     * @var ResourceModelAddressData
     */
    private $_resourceModelAddressData;

    /**
     * @var CollectionFactory
     */
    private $_addressDataCollectionFactory;

    /**
     * @var AddressDataSearchResultsInterfaceFactory
     */
    private $_addressDataSearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    /**
     * AddressDataRepository constructor.
     *
     * @param AddressDataFactory $addressDataFactory
     * @param ResourceModelAddressData $resourceModelAddressData
     * @param CollectionFactory $addressDataCollectionFactory
     * @param AddressDataSearchResultsInterfaceFactory $addressDataSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        AddressDataFactory $addressDataFactory,
        ResourceModelAddressData $resourceModelAddressData,
        CollectionFactory $addressDataCollectionFactory,
        AddressDataSearchResultsInterfaceFactory $addressDataSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_addressDataFactory                       = $addressDataFactory;
        $this->_resourceModelAddressData                 = $resourceModelAddressData;
        $this->_addressDataCollectionFactory             = $addressDataCollectionFactory;
        $this->_addressDataSearchResultsInterfaceFactory = $addressDataSearchResultsInterfaceFactory;
        $this->_collectionProcessor                      = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor         = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($addressId, $netsuiteId, $address, $aptSuite, $state, $isDefaultMyAddress)
    {
        $addressData = $this->_addressDataFactory->create();
        $addressData->setAddressId($addressId);
        $addressData->setNetsuiteId($netsuiteId);
        $addressData->setAddress($address);
        $addressData->setAptSuite($aptSuite);
        $addressData->setState($state);
        $addressData->setIsDefaultMyAddress($isDefaultMyAddress);
        $this->_resourceModelAddressData->save($addressData);
        return $addressData;
    }

    /**
     * @inheritdoc
     */
    public function getById($addressDataId)
    {
        return $this->get($addressDataId);
    }

    /**
     * @inheritdoc
     */
    public function get($value, $attributeCode)
    {
        /** @var AddressData $addressData */
        $addressData = $this->_addressDataFactory->create()->load($value, $attributeCode);

        if (!$addressData->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity'));
        }
        
        return $addressData;
    }

    /**
     * @inheritdoc
     */
    public function delete(AddressDataInterface $addressData)
    {

        $addressDataId = $addressData->getId();

        try {
            $this->_resourceModelAddressData->delete($addressData);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(
                __('Unable to remove entity %1', $addressDataId)
            );
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById($addressDataId)
    {
        $addressData = $this->getById($addressDataId);
        return $this->delete($addressData);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->_addressDataCollectionFactory->create();
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var AddressDataSearchResultsInterface $searchResults */
        $searchResults = $this->_addressDataSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}