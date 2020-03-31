<?php
 
namespace Midwr\Manager\Block\Book;

class Add extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context
    ) 
    {
        parent::__construct($context);
    }
 
    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Register New Book'));
        return parent::_prepareLayout();
    }
}