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
     * Set job title
     *
     * @param string $jobTitle
     * @return $this
     */
    public function setJobTitle($jobTitle);
}