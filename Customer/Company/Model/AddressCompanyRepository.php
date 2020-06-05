<?php

namespace Customer\Company\Model;

use Exception;
use Customer\Company\Api\Data\AddressCompanyInterface;
use Customer\Company\Api\Data\AddressCompanySearchResultsInterface;
use Customer\Company\Api\Data\AddressCompanySearchResultsInterfaceFactory;
use Customer\Company\Api\AddressCompanyRepositoryInterface;
use Customer\Company\Model\AddressCompanyFactory;
use Customer\Company\Model\ResourceModel\AddressCompany as ResourceModelAddressCompany;
use Customer\Company\Model\ResourceModel\AddressCompany\Collection;
use Customer\Company\Model\ResourceModel\AddressCompany\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class AddressCompanyRepository
 */
class AddressCompanyRepository implements AddressCompanyRepositoryInterface
{

    /**
     * @var AddressCompanyFactory
     */
    private $_addressCompanyFactory;

    /**
     * @var ResourceModelAddressCompany
     */
    private $_resourceModelAddressCompany;

    /**
     * @var CollectionFactory
     */
    private $_addressCompanyCollectionFactory;

    /**
     * @var AddressCompanySearchResultsInterfaceFactory
     */
    private $_addressCompanySearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;

    /**
     * AddressCompanyRepository constructor.
     *
     * @param AddressCompanyFactory $addressCompanyFactory
     * @param ResourceModelAddressCompany $resourceModelAddressCompany
     * @param CollectionFactory $addressCompanyCollectionFactory
     * @param AddressCompanySearchResultsInterfaceFactory $addressCompanySearchResultsInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct (
        AddressCompanyFactory $addressCompanyFactory,
        ResourceModelAddressCompany $resourceModelAddressCompany,
        CollectionFactory $addressCompanyCollectionFactory,
        AddressCompanySearchResultsInterfaceFactory $addressCompanySearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->_addressCompanyFactory                       = $addressCompanyFactory;
        $this->_resourceModelAddressCompany                 = $resourceModelAddressCompany;
        $this->_addressCompanyCollectionFactory             = $addressCompanyCollectionFactory;
        $this->_addressCompanySearchResultsInterfaceFactory = $addressCompanySearchResultsInterfaceFactory;
        $this->_collectionProcessor                                 = $collectionProcessor;
        $this->_extensionAttributesJoinProcessor                    = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save($companyId, $address, $aptSuite, $city, $state, $zip, $country,
                                $isDefaultMyAddress, $isDefaultShipping, $isDefaultBilling)
    {
        $addressCompany = $this->_addressCompanyFactory->create();
        $addressCompany->setCompanyId($companyId);
        $addressCompany->setAddress($address);
        $addressCompany->setAptSuite($aptSuite);
        $addressCompany->setCity($city);
        $addressCompany->setState($state);
        $addressCompany->setZip($zip);
        $addressCompany->setCountry($country);
        $addressCompany->setIsDefaultMyAddress($isDefaultMyAddress);
        $addressCompany->setIsDefaultShipping($isDefaultShipping);
        $addressCompany->setIsDefaultBilling($isDefaultBilling);
        $this->_resourceModelAddressCompany->save($addressCompany);
        return $addressCompany;
    }

    /**
     * @inheritdoc
     */
    public function getById($addressCompanyId)
    {
        return $this->get($addressCompanyId);
    }

    /**
     * @inheritdoc
     */
    public function get($value, $attributeCode)
    {
        /** @var AddressCompany $addressCompany */
        $addressCompany = $this->_addressCompanyFactory->create()->load($value, $attributeCode);

        if (!$addressCompany->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity'));
        }
        
        return $addressCompany;
    }

    /**
     * @inheritdoc
     */
    public function delete(AddressCompanyInterface $addressCompany)
    {

        $addressCompanyId = $addressCompany->getId();

        try {
            $this->_resourceModelAddressCompany->delete($addressCompany);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(
                __('Unable to remove entity %1', $addressCompanyId)
            );
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById($addressCompanyId)
    {
        $addressCompany = $this->getById($addressCompanyId);
        return $this->delete($addressCompany);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->_addressCompanyCollectionFactory->create();
        $this->_collectionProcessor->process($searchCriteria, $collection);

        /** @var AddressCompanySearchResultsInterface $searchResults */
        $searchResults = $this->_addressCompanySearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}