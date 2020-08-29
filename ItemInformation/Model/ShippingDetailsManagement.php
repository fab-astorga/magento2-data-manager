<?php
namespace Items\ItemInformation\Model;

use Items\ItemInformation\Api\Data\ShippingDetailsInterface;

class ShippingDetailsManagement implements \Items\ItemInformation\Api\ShippingDetailsManagementInterface {
 
    protected $_shippingDetailsFactory;
    protected $_shippingDetailsRepository;

    public function __construct(
        \Items\ItemInformation\Model\ShippingDetailsFactory $shippingDetailsFactory,
        \Items\ItemInformation\Api\ShippingDetailsRepositoryInterface $shippingDetailsRepository
    ) 
    {
        $this->_shippingDetailsFactory = $shippingDetailsFactory;
        $this->_shippingDetailsRepository = $shippingDetailsRepository;
    }

    /**
     * Returns true if the shipping details saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $shippingDetailsInformation
     * @return boolean
     */
    public function saveShippingDetails($product, $shippingDetailsInformation){
        $shippingDetails;

        try {
            $shippingDetails = $this->_shippingDetailsRepository->getByProductId($product->getIdBySku($product->getSku()));
        } catch(\Exception $error){
            $shippingDetails = $this->_shippingDetailsFactory->create();
            $shippingDetails->setItemId($product->getIdBySku($product->getSku()));
        }

        if (array_key_exists(ShippingDetailsInterface::SCHEDULE_B_NUMBER, $shippingDetailsInformation)) {
            $shippingDetails->setScheduleBNumber($shippingDetailsInformation[ShippingDetailsInterface::SCHEDULE_B_NUMBER]);
        }

        if (array_key_exists(ShippingDetailsInterface::INDIVIDUAL_ITEM_WEIGHT_OZ, $shippingDetailsInformation)) {
            $shippingDetails->setIndividualItemWeightOz($shippingDetailsInformation[ShippingDetailsInterface::INDIVIDUAL_ITEM_WEIGHT_OZ]);
        }

        if (array_key_exists(ShippingDetailsInterface::GIFT_BOX_WEIGHT_OZ, $shippingDetailsInformation)) {
            $shippingDetails->setGiftBoxWeightOz($shippingDetailsInformation[ShippingDetailsInterface::GIFT_BOX_WEIGHT_OZ]);
        }

        if (array_key_exists(ShippingDetailsInterface::TOTAL_ITEM_WEIGHT, $shippingDetailsInformation)) {
            $shippingDetails->setTotalItemWeight($shippingDetailsInformation[ShippingDetailsInterface::TOTAL_ITEM_WEIGHT]);
        }

        if (array_key_exists(ShippingDetailsInterface::TOTAL_ITEM_WEIGHT_UNIT, $shippingDetailsInformation)) {
            $shippingDetails->setTotalItemWeightUnit($shippingDetailsInformation[ShippingDetailsInterface::TOTAL_ITEM_WEIGHT_UNIT]);
        }

        if (array_key_exists(ShippingDetailsInterface::ITEMS_PER_CARTON, $shippingDetailsInformation)) {
            $shippingDetails->setItemsPerCarton($shippingDetailsInformation[ShippingDetailsInterface::ITEMS_PER_CARTON]);
        }

        if (array_key_exists(ShippingDetailsInterface::GIFT_BOX_COLOR, $shippingDetailsInformation)) {
            $shippingDetails->setGiftBoxColor($shippingDetailsInformation[ShippingDetailsInterface::GIFT_BOX_COLOR]);
        }

        if (array_key_exists(ShippingDetailsInterface::PACKAGE, $shippingDetailsInformation)) {
            $shippingDetails->setPackage($shippingDetailsInformation[ShippingDetailsInterface::PACKAGE]);
        }

        if (array_key_exists(ShippingDetailsInterface::CARTON_SIZE, $shippingDetailsInformation)) {
            $shippingDetails->setCartonSize($shippingDetailsInformation[ShippingDetailsInterface::CARTON_SIZE]);
        }

        if (array_key_exists(ShippingDetailsInterface::ADDITIONAL_SHIPPING_COSTS, $shippingDetailsInformation)) {
            $shippingDetails->setAdditionalShippingCosts($shippingDetailsInformation[ShippingDetailsInterface::ADDITIONAL_SHIPPING_COSTS]);
        }

        if (array_key_exists(ShippingDetailsInterface::CARTON_WEIGHT_OZ, $shippingDetailsInformation)) {
            $shippingDetails->setCartonWeightOz($shippingDetailsInformation[ShippingDetailsInterface::CARTON_WEIGHT_OZ]);
        }

        if (array_key_exists(ShippingDetailsInterface::TOTAL_CARTON_WEIGHT_LBS, $shippingDetailsInformation)) {
            $shippingDetails->setTotalCartonWeightLbs($shippingDetailsInformation[ShippingDetailsInterface::TOTAL_CARTON_WEIGHT_LBS]);
        }

        if (array_key_exists(ShippingDetailsInterface::SHIPPING_DATA_VERIFIED, $shippingDetailsInformation)) {
            $shippingDetails->setShippingDataVerified($shippingDetailsInformation[ShippingDetailsInterface::SHIPPING_DATA_VERIFIED]);
        }

        if (array_key_exists(ShippingDetailsInterface::TOTAL_CARTON_PER_PALLET, $shippingDetailsInformation)) {
            $shippingDetails->setTotalCartonsPerPallet($shippingDetailsInformation[ShippingDetailsInterface::TOTAL_CARTON_PER_PALLET]);
        }

        if (array_key_exists(ShippingDetailsInterface::PACK_OUT_QUANTITY, $shippingDetailsInformation)) {
            $shippingDetails->setPackOutQuantity($shippingDetailsInformation[ShippingDetailsInterface::PACK_OUT_QUANTITY]);
        }

        if (array_key_exists(ShippingDetailsInterface::ICE_PACK_REQUIRED, $shippingDetailsInformation)) {
            $shippingDetails->setIcePackRequired($shippingDetailsInformation[ShippingDetailsInterface::ICE_PACK_REQUIRED]);
        }

        $this->_shippingDetailsRepository->save($shippingDetails);

        return true;
    }

}