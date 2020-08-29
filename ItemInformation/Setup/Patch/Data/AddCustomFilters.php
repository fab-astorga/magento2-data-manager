<?php

namespace Items\ItemInformation\Setup\Patch\Data;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddCustomFilters implements DataPatchInterface
{
   /** @var ModuleDataSetupInterface */
   private $moduleDataSetup;

   /** @var EavSetupFactory */
   private $eavSetupFactory;

   /**
    * @param ModuleDataSetupInterface $moduleDataSetup
    * @param EavSetupFactory $eavSetupFactory
    */
   public function __construct(
       ModuleDataSetupInterface $moduleDataSetup,
       EavSetupFactory $eavSetupFactory
   ) {
       $this->moduleDataSetup = $moduleDataSetup;
       $this->eavSetupFactory = $eavSetupFactory;
   }

   /**
    * {@inheritdoc}
    */
   public function apply()
   {
       /** @var EavSetup $eavSetup */
       $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'drinkware_type', [
            'group' =>  'Default',
            'type' => 'int',
            'label' => 'Drinkware Style',
            'input' => 'select',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => null,
            'searchable' => true,
            'filterable' => true,
            'comparable' => false,
            'visible_on_front' => true,
            'used_in_product_listing' => true,
            'unique' => false,
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'drinkware_material', [
            'group' =>  'Default',
            'type' => 'int',
            'label' => 'Drinkware Material',
            'input' => 'select',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => null,
            'searchable' => true,
            'filterable' => true,
            'comparable' => false,
            'visible_on_front' => true,
            'used_in_product_listing' => true,
            'unique' => false,
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'technology_type', [
            'group' =>  'Default',
            'type' => 'int',
            'label' => 'Technology Product Type',
            'input' => 'select',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => null,
            'searchable' => true,
            'filterable' => true,
            'comparable' => false,
            'visible_on_front' => true,
            'used_in_product_listing' => true,
            'unique' => false,
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'power_banks', [
            'group' =>  'Default',
            'type' => 'int',
            'label' => 'Power Banks',
            'input' => 'select',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => null,
            'searchable' => true,
            'filterable' => true,
            'comparable' => false,
            'visible_on_front' => true,
            'used_in_product_listing' => true,
            'unique' => false,
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'imprint_methods_type', [
            'group' =>  'Default',
            'type' => 'int',
            'label' => 'Imprint Method Option',
            'input' => 'select',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => null,
            'searchable' => true,
            'filterable' => true,
            'comparable' => false,
            'visible_on_front' => true,
            'used_in_product_listing' => true,
            'unique' => false,
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'bags_type', [
            'group' =>  'Default',
            'type' => 'int',
            'label' => 'Bag Style',
            'input' => 'select',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => null,
            'searchable' => true,
            'filterable' => true,
            'comparable' => false,
            'visible_on_front' => true,
            'used_in_product_listing' => true,
            'unique' => false,
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'gift_sets_type', [
            'group' =>  'Default',
            'type' => 'int',
            'label' => 'Gift Set Option',
            'input' => 'select',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => null,
            'searchable' => true,
            'filterable' => true,
            'comparable' => false,
            'visible_on_front' => true,
            'used_in_product_listing' => true,
            'unique' => false,
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'confectionary', [
            'group' =>  'Default',
            'type' => 'int',
            'label' => 'Confectionary',
            'input' => 'select',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => null,
            'searchable' => true,
            'filterable' => true,
            'comparable' => false,
            'visible_on_front' => true,
            'used_in_product_listing' => true,
            'unique' => false,
        ]);


        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'lifestyle_type', [
            'group' =>  'Default',
            'type' => 'int',
            'label' => 'Lifestyle Product Option',
            'input' => 'select',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => null,
            'searchable' => true,
            'filterable' => true,
            'comparable' => false,
            'visible_on_front' => true,
            'used_in_product_listing' => true,
            'unique' => false,
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'auto_accessories', [
            'group' =>  'Default',
            'type' => 'int',
            'label' => 'Auto Accessories',
            'input' => 'select',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => null,
            'searchable' => true,
            'filterable' => true,
            'comparable' => false,
            'visible_on_front' => true,
            'used_in_product_listing' => true,
            'unique' => false,
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'tech_sets', [
            'group' =>  'Default',
            'type' => 'int',
            'label' => 'Travel Gift Option',
            'input' => 'select',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => null,
            'searchable' => true,
            'filterable' => true,
            'comparable' => false,
            'visible_on_front' => true,
            'used_in_product_listing' => true,
            'unique' => false,
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'writing_type', [
            'group' =>  'Default',
            'type' => 'int',
            'label' => 'Writing Type',
            'input' => 'select',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => null,
            'searchable' => true,
            'filterable' => true,
            'comparable' => false,
            'visible_on_front' => true,
            'used_in_product_listing' => true,
            'unique' => false,
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'office_type', [
            'group' =>  'Default',
            'type' => 'int',
            'label' => 'Office Product Type',
            'input' => 'select',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => null,
            'searchable' => true,
            'filterable' => true,
            'comparable' => false,
            'visible_on_front' => true,
            'used_in_product_listing' => true,
            'unique' => false,
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'colors', [
            'group' =>  'Default',
            'type' => 'int',
            'label' => 'Colors',
            'input' => 'select',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => null,
            'searchable' => true,
            'filterable' => true,
            'comparable' => false,
            'visible_on_front' => true,
            'used_in_product_listing' => true,
            'unique' => false,
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'vacuum_sealed', [
            'group' =>  'Default',
            'type' => 'int',
            'label' => 'Vacuum Sealed',
            'input' => 'select',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => null,
            'searchable' => true,
            'filterable' => true,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'unique' => false,
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'summer_coolers', [
            'group' =>  'Default',
            'type' => 'int',
            'label' => 'Summer Coolers',
            'input' => 'select',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => null,
            'searchable' => true,
            'filterable' => true,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'unique' => false,
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'breast_cancer_awareness', [
            'group' =>  'Default',
            'type' => 'int',
            'label' => 'Breast Cancer Awareness',
            'input' => 'select',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => null,
            'searchable' => true,
            'filterable' => true,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'unique' => false,
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'back_to_school', [
            'group' =>  'Default',
            'type' => 'int',
            'label' => 'Back to School',
            'input' => 'select',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => null,
            'searchable' => true,
            'filterable' => true,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'unique' => false,
        ]);

    //   $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'drinkware_type');
    //   $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'drinkware_material');
    //   $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'technology_type');
    //   $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'imprint_methods_type');
    //   $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'bags_type');
    //   $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'power_banks');
    //   $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'gift_sets_type');
    //   $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'confectionary');
    //   $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'lifestyle_type');
    //   $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'auto_accessories');
    //   $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'tech_sets');
    //   $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'writing_type');
    //   $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'office_type');
    //   $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'colors');
    //   $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'vacuum_sealed');
    //   $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'summer_coolers');
    //   $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'breast_cancer_awareness');
    //   $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'back_to_school');

   }

   /**
    * {@inheritdoc}
    */
   public static function getDependencies()
   {
       return [];
   }

   /**
    * {@inheritdoc}
    */
   public function getAliases()
   {
       return [];
   }
}