<?php
 
namespace Midwr\Manager\Block\Book;

use \Magento\Framework\View\Element\Template\Context;
use \Magento\Framework\App\ResourceConnection; 
use Midwr\Manager\Model\BookFactory;

class Join extends \Magento\Framework\View\Element\Template 
{ 
    protected $_book;
    protected $_resource;
     
    public function __construct(
    Context $context,
    BookFactory $book,
    ResourceConnection $resource
    )
    {
        $this->_book = $book;
        $this->_resource = $resource;
        parent::__construct($context);
    }
 
    protected function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('JOIN book-author'));
        return parent::_prepareLayout();
    }
     
    public function getJoinData()
    {
        $collection = $this->_book->create()->getCollection();
        $author_table = $this->_resource->getTableName('author_t');
         
        $collection->getSelect()->joinLeft(array('second_table' => $author_table),
                                                 'main_table.author = second_table.name')
                                                 ->group('main_table.author');

        return $collection;
    }
}