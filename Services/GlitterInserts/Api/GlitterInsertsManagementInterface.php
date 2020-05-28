<?php

namespace Services\GlitterInserts\Api;

interface GlitterInsertsManagementInterface 
{ 
    /**
     * Get all glitter inserts
     * 
     * @return $this
     */
    public function getGlitterInserts();
}