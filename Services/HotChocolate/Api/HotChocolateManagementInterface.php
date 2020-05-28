<?php

namespace Services\HotChocolate\Api;

interface HotChocolateManagementInterface 
{ 
    /**
     * Get all hot chocolate options
     * 
     * @return $this
     */
    public function getHotChocolate();
}