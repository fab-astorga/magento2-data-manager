<?php

namespace Customers\Company\Helper;

class PasswordGenerator extends \Magento\Framework\App\Helper\AbstractHelper
{    
    const LENGTH = 20;
    
    /**
     * @var \Magento\Framework\Math\Random
     */
    protected $_mathRandom;
    
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\Math\Random $mathRandom
    ) {        
        $this->_mathRandom = $mathRandom;
        parent::__construct($context);
    }
    
    /**
     * Retrieve random password
     *
     * @return  string
     */
    public function generatePassword()
    {
        $chars = \Magento\Framework\Math\Random::CHARS_LOWERS
                . \Magento\Framework\Math\Random::CHARS_UPPERS
                . \Magento\Framework\Math\Random::CHARS_DIGITS;
        
        return $this->_mathRandom->getRandomString(self::LENGTH, $chars);
    }
}