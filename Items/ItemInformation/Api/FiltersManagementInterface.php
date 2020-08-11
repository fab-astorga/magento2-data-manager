<?php
namespace Items\ItemInformation\Api;

interface FiltersManagementInterface {
 
    // Incoming JSON fields mapping
    const DRINKWARE_TYPE = "drinkware_type";
    const DRINKWARE_MATERIAL = "drinkware_material";
    const TECHNOLOGY_TYPE = "technology_type";
    const IMPRINT_METHODS_TYPE = 'imprint_methods_type';
    const BAGS_TYPE = 'bags_type';
    const POWER_BANKS = 'power_banks';
    const GIFT_SETS_TYPE = 'gift_sets_type';
    const CONFECTIONARY = 'confectionary';
    const LIFESTYLE_TYPE = 'lifestyle_type';
    const AUTO_ACCESSORIES = 'auto_accessories';
    const TECH_SETS = 'tech_sets';
    const WRITING_TYPE = 'writing_type';
    const OFFICE_TYPE = 'office_type';
    const COLORS = 'colors';
    const VACUUM_SEALED = 'vacuum_sealed';
    const SUMMER_COOLERS = 'summer_coolers';
    const BREAST_CANCER_AWARENESS = 'breast_cancer_awareness';
    const BACK_TO_SCHOOL = 'back_to_school';
    const ON_SALE = 'on_sale';
    const _NEW = 'new';
    const CLEARANCE = 'clearance';

    const FILTERS = [
        self::DRINKWARE_TYPE,
        self::DRINKWARE_MATERIAL,
        self::TECHNOLOGY_TYPE,
        self::IMPRINT_METHODS_TYPE,
        self::BAGS_TYPE,
        self::POWER_BANKS,
        self::GIFT_SETS_TYPE,
        self::CONFECTIONARY,
        self::LIFESTYLE_TYPE,
        self::AUTO_ACCESSORIES,
        self::TECH_SETS,
        self::WRITING_TYPE,
        self::OFFICE_TYPE,
        self::COLORS,
        self::VACUUM_SEALED,
        self::SUMMER_COOLERS,
        self::BREAST_CANCER_AWARENESS,
        self::BACK_TO_SCHOOL,
        self::ON_SALE,
        self::_NEW,
        self::CLEARANCE
    ];


    /**
     * Returns true if the filters saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $filtersInformation
     * @return boolean
     */
    public function saveFilters($product, $filtersInformation);


    /**
     * Returns true if the option saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param string $filter
     * @param string $option
     * @return boolean
     */
    public function saveOrUpdateStringOption($product, $filter, $option);

    /**
     * Returns true if the option saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param string $filter
     * @param string $option
     * @return boolean
     */
    public function saveOrUpdateBoolOption($product, $filter, $option);

}