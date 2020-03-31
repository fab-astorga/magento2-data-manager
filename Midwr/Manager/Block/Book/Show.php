<?php
 
namespace Midwr\Manager\Block\Book;
 
use \Magento\Framework\View\Element\Template\Context;
use Midwr\Manager\Model\BookFactory;

class Show extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        Context $context,
        BookFactory $book
    ) {
        $this->_book = $book;
        parent::__construct($context);
    }
 
    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('All Books'));        
        return parent::_prepareLayout();
    }
 
    public function getBooks()
    {
        $books = $this->_book->create();
        $collection = $books->getCollection();
        return $collection;
    }
}