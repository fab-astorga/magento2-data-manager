<?php

namespace Services\PmsColors\Api;

interface PmsColorsManagementInterface 
{ 
    /**
     * Import CSV file with pms color information
     * 
     * @return boolean
     */
    public function importPmsColorsFromCsv();

    /**
     * Get all PMS Colors
     * 
     * @return $this
     */
    public function getPmsColors();
}