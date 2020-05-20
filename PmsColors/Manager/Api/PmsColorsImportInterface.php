<?php

namespace PmsColors\Manager\Api;

interface PmsColorsImportInterface 
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