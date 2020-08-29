<?php
namespace Items\ItemInformation\Model;

use Items\ItemInformation\Api\Data\SafetyDetailsInterface;

class SafetyDetailsManagement implements \Items\ItemInformation\Api\SafetyDetailsManagementInterface {
 
    protected $_safetyDetailsFactory;
    protected $_safetyDetailsRepository;

    public function __construct(
        \Items\ItemInformation\Model\SafetyDetailsFactory $safetyDetailsFactory,
        \Items\ItemInformation\Api\SafetyDetailsRepositoryInterface $safetyDetailsRepository
    ) 
    {
        $this->_safetyDetailsFactory = $safetyDetailsFactory;
        $this->_safetyDetailsRepository = $safetyDetailsRepository;
    }

    /**
     * Returns true if the safety details saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $safetyDetailsInformation
     * @return boolean
     */
    public function saveSafetyDetails($product, $safetyDetailsInformation)
    {
        $safetyDetails;

        try {
            $safetyDetails = $this->_safetyDetailsRepository->getByProductId($product->getIdBySku($product->getSku()));
        } catch(\Exception $error){
            $safetyDetails = $this->_safetyDetailsFactory->create();
            $safetyDetails->setItemId($product->getIdBySku($product->getSku()));
        }

        if (array_key_exists(SafetyDetailsInterface::SAFETY_DETAILS_NAME, $safetyDetailsInformation)) {
            $safetyDetails->setSafetyDetailsName((string)$safetyDetailsInformation[SafetyDetailsInterface::SAFETY_DETAILS_NAME]);
        }

        if (array_key_exists(SafetyDetailsInterface::SAFETY_DETAILS_LINK, $safetyDetailsInformation)) {
            $safetyDetails->setSafetyDetailsLink((string)$safetyDetailsInformation[SafetyDetailsInterface::SAFETY_DETAILS_LINK]);
        }

        if (array_key_exists(SafetyDetailsInterface::SAFETY_DETAILS_NAME_2, $safetyDetailsInformation)) {
            $safetyDetails->setSafetyDetailsNameTwo((string)$safetyDetailsInformation[SafetyDetailsInterface::SAFETY_DETAILS_NAME_2]);
        }

        if (array_key_exists(SafetyDetailsInterface::SAFETY_DETAILS_LINK_2, $safetyDetailsInformation)) {
            $safetyDetails->setSafetyDetailsLinkTwo((string)$safetyDetailsInformation[SafetyDetailsInterface::SAFETY_DETAILS_LINK_2]);
        }

        if (array_key_exists(SafetyDetailsInterface::SAFETY_DETAILS_NAME_3, $safetyDetailsInformation)) {
            $safetyDetails->setSafetyDetailsNameThree((string)$safetyDetailsInformation[SafetyDetailsInterface::SAFETY_DETAILS_NAME_3]);
        }

        if (array_key_exists(SafetyDetailsInterface::SAFETY_DETAILS_LINK_3, $safetyDetailsInformation)) {
            $safetyDetails->setSafetyDetailsLinkThree((string)$safetyDetailsInformation[SafetyDetailsInterface::SAFETY_DETAILS_LINK_3]);
        }

        if (array_key_exists(SafetyDetailsInterface::SAFETY_TEST_LINK, $safetyDetailsInformation)) {
            $safetyDetails->setSafetyTestLink((string)$safetyDetailsInformation[SafetyDetailsInterface::SAFETY_TEST_LINK]);
        }

        if (array_key_exists(SafetyDetailsInterface::FDA_TEST_LINK, $safetyDetailsInformation)) {
            $safetyDetails->setFdaTestLink((string)$safetyDetailsInformation[SafetyDetailsInterface::FDA_TEST_LINK]);
        }

        if (array_key_exists(SafetyDetailsInterface::SAFETY_TEST_DATE, $safetyDetailsInformation)) {
            $safetyDetails->setSafetyTestDate((string)$safetyDetailsInformation[SafetyDetailsInterface::SAFETY_TEST_DATE]);
        }

        if (array_key_exists(SafetyDetailsInterface::PROP65_WARNING, $safetyDetailsInformation)) {
            $safetyDetails->setProp65Warning((bool)$safetyDetailsInformation[SafetyDetailsInterface::PROP65_WARNING]);
        }

        if (array_key_exists(SafetyDetailsInterface::SAFETY_TEST_AVAILABLE, $safetyDetailsInformation)) {
            $safetyDetails->setSafetyTestAvailable((bool)$safetyDetailsInformation[SafetyDetailsInterface::SAFETY_TEST_AVAILABLE]);
        }


        $this->_safetyDetailsRepository->save($safetyDetails);

        return true;
    }

}