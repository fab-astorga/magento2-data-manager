<?php
namespace Items\ImprintMethods\Api;

interface ImprintMethodsManagementInterface 
{
    /**
     * POST from NetSuite with Imprint Methods Information
     * @return boolean
     */
    public function saveImprintMethods();

    /**
     * DELETE from NetSuite with the imprint method id
     * @param int $id
     * @return boolean
     */
    public function deleteImprintMethod($id);

}