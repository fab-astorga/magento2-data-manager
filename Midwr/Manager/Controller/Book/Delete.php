<?php
 
namespace Midwr\Manager\Controller\Book;
 
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\App\ResourceConnection; 
use \Magento\Framework\App\Cache\TypeListInterface;
use \Magento\Framework\App\Cache\Frontend\Pool;
use Midwr\Manager\Model\BookFactory;

class Delete extends \Magento\Framework\App\Action\Action
{
	protected $_book;
    protected $_logger;
    protected $_cacheTypeList;
    protected $_cacheFrontendPool;
 
	public function __construct(
		Context $context,
        BookFactory $book,
        ResourceConnection $resource,
        TypeListInterface $cacheTypeList,
        Pool $cacheFrontendPool
    ) {
        $this->_book = $book;
        $this->_resource = $resource;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheFrontendPool = $cacheFrontendPool;
        parent::__construct($context);
    }
	public function execute()
    {
        /****** Custom indexer test ******/
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $buildOpt = $objectManager->create('Midwr\Manager\Model\Indexer\CustomIndexer');

        $id = $this->getRequest()->getParam('id');
        $table = $this->_resource->getTableName("book_t");
        $connection = $this->_resource->getConnection();
        $result = $connection->delete($table, ["book_id = '$id'"]);
        $buildOpt->executeRow($id);

        $checkMessage = ($result) ? 'You delete the data.' :  'Data was not deleted.';
        $this->messageManager->addNoticeMessage(__($checkMessage));
        
            // Clean cache in order to catch changes
        $types = array('block_html','collections','db_ddl');
        foreach ($types as $type) {
            $this->_cacheTypeList->cleanType($type);
        }
        foreach ($this->_cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('manager/book/select');
        return $resultRedirect;
    }
}