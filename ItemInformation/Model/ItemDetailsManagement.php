<?php
namespace Items\ItemInformation\Model;

use Items\ItemInformation\Api\Data\ItemDetailsInterface;

class ItemDetailsManagement implements \Items\ItemInformation\Api\ItemDetailsManagementInterface {
 
    protected $_itemDetailsFactory;
    protected $_itemDetailsRepository;

    public function __construct(
        \Items\ItemInformation\Model\ItemDetailsFactory $itemDetailsFactory,
        \Items\ItemInformation\Api\ItemDetailsRepositoryInterface $itemDetailsRepository
    ) 
    {
        $this->_itemDetailsFactory = $itemDetailsFactory;
        $this->_itemDetailsRepository = $itemDetailsRepository;
    }

    /**
     * Returns true if the item details saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $itemDetailsInformation
     * @return boolean
     */
    public function saveItemDetails($product, $itemDetailsInformation){
        $itemDetails;

        try {
            $itemDetails = $this->_itemDetailsRepository->getByProductId($product->getIdBySku($product->getSku()));
        } catch(\Exception $error){
            $itemDetails = $this->_itemDetailsFactory->create();
            $itemDetails->setItemId($product->getIdBySku($product->getSku()));
        }

        if (array_key_exists(ItemDetailsInterface::SALES_DESCRIPTION, $itemDetailsInformation)) {
            $itemDetails->setSalesDescription((string)$itemDetailsInformation[ItemDetailsInterface::SALES_DESCRIPTION]);
        }

        if (array_key_exists(ItemDetailsInterface::ITEM_PMS_COLOR, $itemDetailsInformation)) {
            $itemDetails->setItemPMSColor((string)$itemDetailsInformation[ItemDetailsInterface::ITEM_PMS_COLOR]);
        }

        if (array_key_exists(ItemDetailsInterface::ITEM_VOLUME_IN_OZ, $itemDetailsInformation)) {
            $itemDetails->setItemVolumeInOz((float)$itemDetailsInformation[ItemDetailsInterface::ITEM_VOLUME_IN_OZ]);
        }

        if (array_key_exists(ItemDetailsInterface::ITEM_PACKAGING, $itemDetailsInformation)) {
            $itemDetails->setItemPackaging((string)$itemDetailsInformation[ItemDetailsInterface::ITEM_PACKAGING]);
        }

        if (array_key_exists(ItemDetailsInterface::ITEM_MATERIAL, $itemDetailsInformation)) {
            if($itemDetailsInformation[ItemDetailsInterface::ITEM_MATERIAL]){
                $itemDetails->setItemMaterial((string)$itemDetailsInformation[ItemDetailsInterface::ITEM_MATERIAL][0]);
            }
        }

        if (array_key_exists(ItemDetailsInterface::ITEM_GUSSET, $itemDetailsInformation)) {
            $itemDetails->setItemGusset((int)$itemDetailsInformation[ItemDetailsInterface::ITEM_GUSSET]);
        }

        if (array_key_exists(ItemDetailsInterface::ITEM_HANDLE_LENGTH, $itemDetailsInformation)) {
            $itemDetails->setItemHandleLength((int)$itemDetailsInformation[ItemDetailsInterface::ITEM_HANDLE_LENGTH]);
        }

        if (array_key_exists(ItemDetailsInterface::ITEM_DEPTH, $itemDetailsInformation)) {
            $itemDetails->setItemDepth((float)$itemDetailsInformation[ItemDetailsInterface::ITEM_DEPTH]);
        }

        if (array_key_exists(ItemDetailsInterface::ITEM_WIDTH, $itemDetailsInformation)) {
            $itemDetails->setItemWidth((float)$itemDetailsInformation[ItemDetailsInterface::ITEM_WIDTH]);
        }

        if (array_key_exists(ItemDetailsInterface::ITEM_HEIGHT, $itemDetailsInformation)) { 
            $itemDetails->setItemHeight((float)$itemDetailsInformation[ItemDetailsInterface::ITEM_HEIGHT]);
        }

        if (array_key_exists(ItemDetailsInterface::ITEM_TOP_DIAMETER, $itemDetailsInformation)) {
            $itemDetails->setItemTopDiameter((float)$itemDetailsInformation[ItemDetailsInterface::ITEM_TOP_DIAMETER]);
        }

        if (array_key_exists(ItemDetailsInterface::ITEM_BOTTOM_DIAMETER, $itemDetailsInformation)) {
            $itemDetails->setItemBottomDiameter((float)$itemDetailsInformation[ItemDetailsInterface::ITEM_BOTTOM_DIAMETER]);
        }

        if (array_key_exists(ItemDetailsInterface::ITEM_LENGTH, $itemDetailsInformation)) {
            $itemDetails->setItemLength((float)$itemDetailsInformation[ItemDetailsInterface::ITEM_LENGTH]);
        }

        if (array_key_exists(ItemDetailsInterface::ITEM_DIAMETER, $itemDetailsInformation)) {
            $itemDetails->setItemDiameter((float)$itemDetailsInformation[ItemDetailsInterface::ITEM_DIAMETER]);
        }

        if (array_key_exists(ItemDetailsInterface::FITS_CAR_CUP_HOLDER, $itemDetailsInformation)) {
            $itemDetails->setFitsCarCupHolder((bool)$itemDetailsInformation[ItemDetailsInterface::FITS_CAR_CUP_HOLDER]);
        }

        if (array_key_exists(ItemDetailsInterface::MICROWAVE_SAFE, $itemDetailsInformation)) {
            $itemDetails->setMicrowaveSafe((bool)$itemDetailsInformation[ItemDetailsInterface::MICROWAVE_SAFE]);
        }

        if (array_key_exists(ItemDetailsInterface::TOP_RACK_DISHWASHER_SAFE, $itemDetailsInformation)) {
            $itemDetails->setTopRackDishwasherSafe((bool)$itemDetailsInformation[ItemDetailsInterface::TOP_RACK_DISHWASHER_SAFE]);
        }

        if (array_key_exists(ItemDetailsInterface::CARABINER_INCLUDED, $itemDetailsInformation)) {
            $itemDetails->setCarabinerIncluded((bool)$itemDetailsInformation[ItemDetailsInterface::CARABINER_INCLUDED]);
        }

        if (array_key_exists(ItemDetailsInterface::SPILL_PROOF, $itemDetailsInformation)) {
            $itemDetails->setSpillProof((bool)$itemDetailsInformation[ItemDetailsInterface::SPILL_PROOF]);
        }

        if (array_key_exists(ItemDetailsInterface::SPILL_PRESISTANT, $itemDetailsInformation)) {
            $itemDetails->setSpillPersistant((bool)$itemDetailsInformation[ItemDetailsInterface::SPILL_PRESISTANT]);
        }

        if (array_key_exists(ItemDetailsInterface::HANDWASH_ONLY, $itemDetailsInformation)) {
            $itemDetails->setHandwashOnly((bool)$itemDetailsInformation[ItemDetailsInterface::HANDWASH_ONLY]);
        }

        if (array_key_exists(ItemDetailsInterface::PATENT_NUMBER, $itemDetailsInformation)) {
            $itemDetails->setPatentNumber((string)$itemDetailsInformation[ItemDetailsInterface::PATENT_NUMBER]);
        }

        if (array_key_exists(ItemDetailsInterface::RECYCLE_NUMBER, $itemDetailsInformation)) {
            $itemDetails->setRecycleNumber((string)$itemDetailsInformation[ItemDetailsInterface::RECYCLE_NUMBER]);
        }
        if (array_key_exists(ItemDetailsInterface::MAH, $itemDetailsInformation)) {
            $itemDetails->setMAH((string)$itemDetailsInformation[ItemDetailsInterface::MAH]);
        }

        if (array_key_exists(ItemDetailsInterface::BATTERIES_INCLUDED, $itemDetailsInformation)) {
            $itemDetails->setBatteriesIncluded((bool)$itemDetailsInformation[ItemDetailsInterface::BATTERIES_INCLUDED]);
        }

        $this->_itemDetailsRepository->save($itemDetails);

        return true;
    }

}