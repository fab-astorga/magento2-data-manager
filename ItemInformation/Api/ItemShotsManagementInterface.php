<?php
namespace Items\ItemInformation\Api;

interface ItemShotsManagementInterface {

    const MAIN_SHOTS = 'main_shots';
    const MATRIX_SHOTS = 'matrix_shots';

    /**
     * Returns true if the item shots saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $itemShotsInformation
     * @param string $isConfigurableWithoutSimples
     * @return boolean
     */
    public function saveItemShots($product, $itemShotsInformation, $isConfigurableWithoutSimples);

    /**
     * Returns true if the item shots saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $itemMainShotsInformation
     * @return boolean
     */
    public function saveItemMainShots($product, $itemMainShotsInformation);


    /**
     * Returns true if the item shots saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $images
     * @return boolean
     */
    public function saveProductMainImages($product, $images);

    /**
     * Returns true if the item shots saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $itemMatrixShotsInformation
     * @return boolean
     */
    public function saveItemMatrixShots($product, $itemMatrixShotsInformation);


    /**
     * Returns true if the item shots saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $images
     * @return boolean
     */
    public function saveProductMatrixImages($product, $images);


    /**
     * Returns true if the item images deleted correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $images
     * @return boolean
     */
    public function deletePreviousProductImages($product);

}