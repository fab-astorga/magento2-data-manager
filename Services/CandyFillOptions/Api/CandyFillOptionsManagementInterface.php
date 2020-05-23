<?php

namespace Services\CandyFillOptions\Api;

interface CandyFillOptionsManagementInterface 
{ 
    /**
     * Import CSV file with candy fill options and prices information
     * 
     * @return boolean
     */
    public function importCandyFillOptionsFromCsv();

    /**
     * Get all candy fill options
     * 
     * @return $this
     */
    public function getCandyFillOptions();
}