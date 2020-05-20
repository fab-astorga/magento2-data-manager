<?php

namespace HotChocolate\Manager\Api;

interface HotChocolateManagementInterface 
{ 
    /**
     * Import CSV file with hot chocolate and prices information
     * 
     * @return boolean
     */
    public function importHotChocolateFromCsv();

    /**
     * Get all hot chocolate options
     * 
     * @return $this
     */
    public function getHotChocolate();
}