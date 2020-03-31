<?php
 
namespace Midwr\Manager\Block\Author;
 
use \Magento\Framework\View\Element\Template\Context;
use Midwr\Manager\Model\AuthorFactory;

class Show extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        Context $context,
        AuthorFactory $author
    ) {
        $this->_author = $author;
        parent::__construct($context);
    }
 
    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('All Authors'));        
        return parent::_prepareLayout();
    }
 
    public function getAuthors()
    {
        $authors = $this->_author->create();
        $collection = $authors->getCollection();
        return $collection;
    }
}