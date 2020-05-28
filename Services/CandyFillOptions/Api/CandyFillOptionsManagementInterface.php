<?php

namespace Services\CandyFillOptions\Api;

interface CandyFillOptionsManagementInterface 
{ 
    /**
     * Get all candy fill options
     * 
     * @return $this
     */
    public function getCandyFillOptions();
}