<?php

namespace Items\ImprintMethods\Model;
use Items\ImprintMethods\Api\ImprintMethodsManagementInterface;

class ImprintMethodsManagement implements ImprintMethodsManagementInterface
{
    // Incoming JSON fields mapping
    const IMPRINT_METHOD_ID = 'id';
    const IMPRINT_METHOD_NAME = 'name';
    const IMPRINT_METHOD_NUMBER = 'number';
    const IMPRINT_METHOD_PAGE_TITLE = 'pageTitle';
    const IMPRINT_METHOD_DESCRIPTION_TITLE = 'descriptionTitle';
    const IMPRINT_METHOD_DESCRIPTION_CONTENT = 'descriptionContent';
    const IMPRINT_METHOD_IMAGES = 'images';
    const IMPRINT_METHOD_PRICES = 'prices'; 

    public function __construct( ) 
    {
    }

    /**
     * {@inheritdoc}
     * 
     * This method makes an update or save of Imprint Methods.
     */
    public function saveImprintMethods()
    { 
    }

    public function deleteImprintMethod($id)
    { 
    }
}