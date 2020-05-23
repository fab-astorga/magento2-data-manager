<?php

namespace DistributorTools\FlyersEblasts\Api;

interface FlyersEblastsManagementInterface 
{ 
    /**
     * Import CSV file with flyers abd eblasts information
     * 
     * @return boolean
     */
    public function importFlyersEblastsFromCsv();

    /**
     * Get all flyers abd eblasts
     * 
     * @return $this
     */
    public function getFlyersEblasts();
}