<?php
 
namespace Midwr\Manager\Block\Book;

class Update extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context
    ) 
    {
        parent::__construct($context);
    }
 
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getBookId()
    {
        $id = $this->getRequest()->getParam('id');
        return $id;
    }
}