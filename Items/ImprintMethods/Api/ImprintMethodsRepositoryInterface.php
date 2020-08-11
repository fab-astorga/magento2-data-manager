<?php

namespace Items\ImprintMethods\Api;
use Items\ImprintMethods\Api\Data\ImprintMethodInterface;
/**
 * Interface ImprintMethodsRepositoryInterface
 */
interface ImprintMethodsRepositoryInterface
{
    /**
     * Save imprint method
     *
     * @param int $netsuiteId
     * @param int $imcGroupId
     * @param int $imcSetupItemId
     * @param int $imcFirstRunItemId
     * @param int $imcAddRunItemId
     * @param int $imcResetUpItemId
     * @param int $imcExactPlacItemId
     * @param int $imcPmsOnlineItemId
     * @param int $imcInkChangeItemId
     * @param int $imcLtmItemId
     * @param string $imcLocationName
     * @param string $imprintWidth
     * @param string $imprintHeight
     * @return \Items\ImprintMethods\Api\Data\ImprintMethodInterface
     */
    public function save($netsuiteId, $imcGroupId, $imcSetupItemId, $imcFirstRunItemId, $imcAddRunItemId,
                         $imcResetUpItemId, $imcExactPlacItemId, $imcPmsOnlineItemId, $imcInkChangeItemId,
                         $imcLtmItemId, $imcLocationName, $imprintWidth, $imprintHeight);

    /**
     * Retrieve imprint method by id
     *
     * @param int $imprintMethodsId
     * @return \DistributorTools\StockArtLibrary\Api\Data\ImprintMethodInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($imprintMethodsId);

    /**
     * Delete imprint method by ID.
     *
     * @param int $imprintMethodsId
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($imprintMethodsId);

    /**
     * Delete imprint methods
     * @param ImprintMethodInterface $ImprintMethod
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(ImprintMethodInterface $ImprintMethod);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Items\ImprintMethods\Api\Data\ImprintMethodSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}