<?php
namespace Items\ItemInformation\Model;

class FiltersManagement implements \Items\ItemInformation\Api\FiltersManagementInterface {
    
    protected $_attributeOptions;
    protected $_productRepository;
    
    public function __construct(
        \Items\ItemInformation\Helper\AttributeOptions $attributeOptions,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
    ) {
        $this->_attributeOptions = $attributeOptions;
        $this->_productRepository = $productRepository;
    }

    /**
     * Returns true if the filters saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $filtersInformation
     * @return boolean
     */
    public function saveFilters($product, $filtersInformation)
    {
        if (array_key_exists(SELF::DRINKWARE_TYPE, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::DRINKWARE_TYPE, $filtersInformation[SELF::DRINKWARE_TYPE]);
        }

        if (array_key_exists(SELF::DRINKWARE_MATERIAL, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::DRINKWARE_MATERIAL, $filtersInformation[SELF::DRINKWARE_MATERIAL]);
        }

        if (array_key_exists(SELF::TECHNOLOGY_TYPE, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::TECHNOLOGY_TYPE, $filtersInformation[SELF::TECHNOLOGY_TYPE]);
        }

        if (array_key_exists(SELF::IMPRINT_METHODS_TYPE, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::IMPRINT_METHODS_TYPE, $filtersInformation[SELF::IMPRINT_METHODS_TYPE]);
        }

        if (array_key_exists(SELF::BAGS_TYPE, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::BAGS_TYPE, $filtersInformation[SELF::BAGS_TYPE]);
        }

        if (array_key_exists(SELF::POWER_BANKS, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::POWER_BANKS, $filtersInformation[SELF::POWER_BANKS]);
        }

        if (array_key_exists(SELF::GIFT_SETS_TYPE, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::GIFT_SETS_TYPE, $filtersInformation[SELF::GIFT_SETS_TYPE]);
        }

        if (array_key_exists(SELF::CONFECTIONARY, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::CONFECTIONARY, $filtersInformation[SELF::CONFECTIONARY]);
        }

        if (array_key_exists(SELF::LIFESTYLE_TYPE, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::LIFESTYLE_TYPE, $filtersInformation[SELF::LIFESTYLE_TYPE]);
        }

        if (array_key_exists(SELF::AUTO_ACCESSORIES, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::AUTO_ACCESSORIES, $filtersInformation[SELF::AUTO_ACCESSORIES]);
        }

        if (array_key_exists(SELF::TECH_SETS, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::TECH_SETS, $filtersInformation[SELF::TECH_SETS]);
        }

        if (array_key_exists(SELF::WRITING_TYPE, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::WRITING_TYPE, $filtersInformation[SELF::WRITING_TYPE]);
        }

        if (array_key_exists(SELF::OFFICE_TYPE, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::OFFICE_TYPE, $filtersInformation[SELF::OFFICE_TYPE]);
        }

        if (array_key_exists(SELF::COLORS, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::COLORS, $filtersInformation[SELF::COLORS]);
        }

        if (array_key_exists(SELF::VACUUM_SEALED, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::VACUUM_SEALED, $filtersInformation[SELF::VACUUM_SEALED]);
        }

        if (array_key_exists(SELF::SUMMER_COOLERS, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::SUMMER_COOLERS, $filtersInformation[SELF::SUMMER_COOLERS]);
        }

        if (array_key_exists(SELF::BREAST_CANCER_AWARENESS, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::BREAST_CANCER_AWARENESS, $filtersInformation[SELF::BREAST_CANCER_AWARENESS]);
        }

        if (array_key_exists(SELF::BACK_TO_SCHOOL, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::BACK_TO_SCHOOL, $filtersInformation[SELF::BACK_TO_SCHOOL]);
        }

        if (array_key_exists(SELF::ON_SALE, $filtersInformation)) {
            $option;
            // In netsuite this information is boolean
            if($filtersInformation[SELF::ON_SALE] == true){
                $option = "Yes";
            } else {
                $option = "No";
            }
            $this->saveOrUpdateStringOption($product, SELF::ON_SALE, $option);
        }

        if (array_key_exists(SELF::_NEW, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::_NEW, $filtersInformation[SELF::_NEW]);
        }

        if (array_key_exists(SELF::CLEARANCE, $filtersInformation)) {
            $this->saveOrUpdateStringOption($product, SELF::CLEARANCE, $filtersInformation[SELF::CLEARANCE]);
        }

        $this->_productRepository->save($product);
    }

    /**
     * Returns true if the option saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param string $filter
     * @param string $option
     * @return boolean
     */
    public function saveOrUpdateStringOption($product, $filter, $option) 
    {
        // All stores
        $store_id = 0;

        // If the attribute exist
        try{
            $product->getCustomAttribute($filter)->getValue();
            if(!empty($option))
            {  
                $optionId = $this->_attributeOptions->createOrGetId($filter, $option);
                $product->addAttributeUpdate($filter, $optionId, $store_id);
            }else {
                // Remove attribute
                $product->addAttributeUpdate($filter, 0, $store_id);
            }
        // If not exist
        } catch(\Error $error) {
            if(!empty($option))
            { 
                $optionId = $this->_attributeOptions->createOrGetId($filter, $option);
                $product->setCustomAttribute($filter, $optionId);
            }
        }
    }

    /**
     * Returns true if the option saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param string $filter
     * @param string $option
     * @return boolean
     */
    public function saveOrUpdateBoolOption($product, $filter, $option) 
    {
        // All stores
        $store_id = 0;
        $value = 2;

        if($option === "Yes"){
            $value = true;
        } elseif ($option === "No"){
            $value = false;
        }

        // If the attribute exist
        try{
            $product->getCustomAttribute($filter)->getValue();
            $product->addAttributeUpdate($filter, $value, $store_id);
        // If not exist
        } catch(\Error $error){
            $product->setCustomAttribute($filter, $value);
        }
    }

}