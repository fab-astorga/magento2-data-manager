<?php

namespace Customer\Address\Model;

use Exception;
use Customer\Address\Api\Data\AddressExtraAttributesInterface;
use Customer\Address\Api\Data\AddressExtraAttributesSearchResultsInterface;
use Customer\Address\Api\Data\AddressExtraAttributesSearchResultsInterfaceFactory;
use Customer\Address\Api\AddressExtraAttributesRepositoryInterface;
use Customer\Address\Model\AddressExtraAttributesFactory;
use Customer\Address\Model\ResourceModel\AddressExtraAttributes as ResourceModelAddressExtraAttributes;
use Customer\Address\Model\ResourceModel\AddressExtraAttributes\Collection;
use Customer\Address\Model\ResourceModel\AddressExtraAttributes\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class AddressExtraAttributesRepository
 */
class AddressExtraAttributesRepository implements AddressExtraAttributesRepositoryInterface
{

    /**
     * @var AddressExtraAttributesFactory
     */
    private $_addressExtraAttributesFactory;

    /**
     * @var ResourceModelAddressExtraAttributes
     */
    private $_resourceModelAddressExtraAttributes;

    /**
     * @var CollectionFactory
     */
    private $_addressExtraAttributesCollectionFactory;

    /**
     * @var AddressExtraAttributesSearchResultsInterfaceFactory
     */
    private $_addressExtraAttributesSearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    /**
     * AddressExtraAttributesRepository constructor.
     *
     * @param AddressExtraAttributesFactory $addressExtraAttributesFactory
     * @param ResourceModelAddressExtraAttributes $resourceModelAddressExtraAttributes
     * @param CollectionFactory $addressExtraAttributesCollectionFactory
     * @param AddressExtraAttributesSearchResultsInterfaceFactory $addressExtraAttributesSearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        AddressExtraAttributesFactory $addressExtraAttributesFactory,
        ResourceModelAddressExtraAttributes $resourceModelAddressExtraAttributes,
        CollectionFactory $addressExtraAttributesCollectionFactory,
        AddressExtraAttributesSearchResultsInterfaceFactory $addressExtraAttributesSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_addressExtraAttributesFactory                       = $addressExtraAttributesFactory;
        $this->_resourceModelAddressExtraAttributes                 = $resourceModelAddressExtraAttributes;
        $this->_addressExtraAttributesCollectionFactory             = $addressExtraAttributesCollectionFactory;
        $this->_addressExtraAttributesSearchResultsInterfaceFactory = $addressExtraAttributesSearchResultsInterfaceFactory;
        $this->_collectionProcessor                                 = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor                    = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($addressId, $address, $aptSuite, $state, $isDefaultMyAddress)
    {
        $addressExtraAttributes = $this->_addressExtraAttributesFactory->create();
        $addressExtraAttributes->setAddressId($addressId);
        $addressExtraAttributes->setAddress($address);
        $addressExtraAttributes->setAptSuite($aptSuite);
        $addressExtraAttributes->setState($state);
        $addressExtraAttributes->setIsDefaultMyAddress($isDefaultMyAddress);
        $this->_resourceModelAddressExtraAttributes->save($addressExtraAttributes);
        return $addressExtraAttributes;
    }

    /**
     * @inheritdoc
     */
    public function getById($addressExtraAttributesId)
    {
        return $this->get($addressExtraAttributesId);
    }

    /**
     * @inheritdoc
     */
    public function get($value, $attributeCode)
    {
        /** @var AddressExtraAttributes $addressExtraAttributes */
        $addressExtraAttributes = $this->_addressExtraAttributesFactory->create()->load($value, $attributeCode);

        if (!$addressExtraAttributes->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity'));
        }
        
        return $addressExtraAttributes;
    }

    /**
     * @inheritdoc
     */
    public function delete(AddressExtraAttributesInterface $addressExtraAttributes)
    {

        $addressExtraAttributesId = $addressExtraAttributes->getId();

        try {
            $this->_resourceModelAddressExtraAttributes->delete($addressExtraAttributes);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(
                __('Unable to remove entity %1', $addressExtraAttributesId)
            );
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById($addressExtraAttributesId)
    {
        $addressExtraAttributes = $this->getById($addressExtraAttributesId);
        return $this->delete($addressExtraAttributes);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->_addressExtraAttributesCollectionFactory->create();
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var AddressExtraAttributesSearchResultsInterface $searchResults */
        $searchResults = $this->_addressExtraAttributesSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}