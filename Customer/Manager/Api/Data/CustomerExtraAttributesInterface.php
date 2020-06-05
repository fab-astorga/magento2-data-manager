<?php

namespace Customer\Manager\Api\Data;

/**
 * Interface CustomerExtraAttributesInterface
 */
interface CustomerExtraAttributesInterface
{
    const TABLE        = 'customer_extra_attributes';
    const ID           = 'id';
    const CUSTOMER_ID  = 'customer_id';
    const NETSUITE_ID  = 'netsuite_id';
    const ROLE         = 'role';
    const JOB_TITLE    = 'job_title';
    const PERMISSION   = 'permission';

    /**
     * Retrieve the customer id
     *
     * @return int
     */
    public function getCustomerId();

    /**
     * Set customer id
     *
     * @param int $customerId
     * @return $this
     */
    public function setCustomerId($customerId);

    /**
     * Retrieve the netsuite id
     *
     * @return int
     */
    public function getNetsuiteId();

    /**
     * Set netsuite id
     *
     * @param int $netsuiteId
     * @return $this
     */
    public function setNetsuiteId($netsuiteId);

    /**
     * Retrieve the role
     *
     * @return string
     */
    public function getRole();

    /**
     * Set role
     *
     * @param string $role
     * @return $this
     */
    public function setRole($role);

    /**
     * Retrieve the job title
     *
     * @return string
     */
    public function getJobTitle();

    /**
     * Set job title
     *
     * @param string $jobTitle
     * @return $this
     */
    public function setJobTitle($jobTitle);

    /**
     * Retrieve the permission
     *
     * @return boolean
     */
    public function getPermission();

    /**
     * Set job title
     *
     * @param boolean $permission
     * @return $this
     */
    public function setPermission($permission);
}