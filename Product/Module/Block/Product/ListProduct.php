<?php

namespace Product\Module\Block\Product;

class ListProduct extends \Magento\Catalog\Block\Product\ListProduct {

    public function getOnSaleValue($product)
    {
        try{
            $label = $product->getAttributeText('on_sale');
            if($label === "Yes"){
                return true;
            }else{
                return false;
            }
        } catch(\Exception $error){
            return false;
        }
    }

    public function getClearanceValue($product){
        try{
            $label = $product->getAttributeText('clearance');
            if($label === "Yes"){
                return true;
            }else{
                return false;
            }
        } catch(\Exception $error){
            return false;
        }
    }

    public function getNewValue($product){
        try{
            $label = $product->getAttributeText('new');
            if($label === "Yes"){
                return true;
            }else{
                return false;
            }
        } catch(\Exception $error){
            return false;
        }
    }

}