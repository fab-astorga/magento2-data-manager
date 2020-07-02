<?php

namespace Customers\Contact\Model;

use Customers\Contact\Api\Data\CustomerDataExtensionInterface;

class CustomerData extends \Magento\Framework\Model\AbstractModel implements \Customers\Contact\Api\Data\CustomerDataInterface
{
    protected function _construct()
    {
        $this->_init('Customers\Contact\Model\ResourceModel\CustomerData');
    }

    /**
     * @inheritdoc
     */
    public function setCustomerId($customerId)
    {
        return $this->setData('customer_id', $customerId);
    }

    /**
     * @inheritdoc
     */
    public function getCustomerId()
    {
        return $this->getData('customer_id');
    }

    /**
     * @inheritdoc
     */
    public function setCustomerType($customerType)
    {
        return $this->setData('customer_type', $customerType);
    }

    /**
     * @inheritdoc
     */
    public function getCustomerType()
    {
        return $this->getData('customer_type');
    }
}