<?php

namespace Services\ConfettiInserts\Api;

interface ConfettiInsertsManagementInterface 
{ 
    /**
     * Get all confetti inserts
     * 
     * @return $this
     */
    public function getConfettiInserts();
}