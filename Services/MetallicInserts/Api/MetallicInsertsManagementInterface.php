<?php

namespace Services\MetallicInserts\Api;

interface MetallicInsertsManagementInterface 
{ 
    /**
     * Import CSV file with metallic insert and prices information
     * 
     * @return boolean
     */
    public function importMetallicInsertsFromCsv();

    /**
     * Get all metallic inserts
     * 
     * @return Services\GlitterInserts\Api\Data\GlitterMetallicInsertsPricesInterface[]
     */
    public function getMetallicInserts();
}