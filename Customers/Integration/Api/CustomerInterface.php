<?php

namespace Customers\Integration\Api;

interface CustomerInterface 
{
    /**
     * @param  array $data
     * @return string
     */
    public function postCompanyRegistration($data);

    /**
     * @param  array $data
     * @return string
     */
    public function deleteCompanyNetsuite($data);
}