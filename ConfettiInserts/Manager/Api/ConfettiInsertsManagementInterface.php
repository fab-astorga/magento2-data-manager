<?php

namespace ConfettiInserts\Manager\Api;

interface ConfettiInsertsManagementInterface 
{ 
    /**
     * Import CSV file with confetti insert and prices information
     * 
     * @return boolean
     */
    public function importConfettiInsertsFromCsv();

    /**
     * Get all confetti inserts
     * 
     * @return $this
     */
    public function getConfettiInserts();
}