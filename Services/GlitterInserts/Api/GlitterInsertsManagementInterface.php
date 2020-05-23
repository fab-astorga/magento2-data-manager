<?php

namespace Services\GlitterInserts\Api;

interface GlitterInsertsManagementInterface 
{ 
    /**
     * Import CSV file with glitter insert and prices information
     * 
     * @return boolean
     */
    public function importGlitterInsertsFromCsv();

    /**
     * Get all glitter inserts
     * 
     * @return $this
     */
    public function getGlitterInserts();
}