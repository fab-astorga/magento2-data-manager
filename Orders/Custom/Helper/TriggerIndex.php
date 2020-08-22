<?php

namespace Orders\Custom\Helper;

class TriggerIndex
{
    protected $_coreSession;

    public function __construct(
        \Magento\Framework\Session\SessionManagerInterface $coreSession
    ) {
        $this->_coreSession = $coreSession;
    }

    public function setValue($value)
    {
        $this->_coreSession->start();
        $this->_coreSession->setTriggerIndex($value);
    }

    public function getValue()
    {
        $this->_coreSession->start();
        return $this->_coreSession->getTriggerIndex();
    }

    public function unsetValue()
    {
        $this->_coreSession->start();
        return $this->_coreSession->unsTriggerIndex();
    }
}