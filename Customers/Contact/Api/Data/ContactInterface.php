<?php

namespace Customers\Contact\Api\Data;

/**
 * Interface ContactInterface
 */
interface ContactInterface
{
    const TABLE        = 'contact_customer';
    const ID           = 'id';


     /**
     * Retrieve the email
     *
     * @return int
     */
    public function getEmail();

    /**
     * Set email
     *
     * @param int $email
     * @return $this
     */
    public function setEmail($email);


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
     * Retrieve the company id
     *
     * @return int
     */
    public function getCompanyId();

    /**
     * Set company id
     *
     * @param int $companyId
     * @return $this
     */
    public function setCompanyId($companyId);

    /**
     * Retrieve the job title
     *
     * @return string
     */
    public function getJobTitle();

    /**
     * Set phone
     *
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone);

    /**
     * Retrieve the phone
     *
     * @return string
     */
    public function getPhone();

    /**
     * Set job title
     *
     * @param string $jobTitle
     * @return $this
     */
    public function setJobTitle($jobTitle);

    /**
     * Retrieve access
     *
     * @return boolean
     */
    public function getAccess();

    /**
     * Set access
     *
     * @param boolean $access
     * @return $this
     */
    public function setAccess($access);
}