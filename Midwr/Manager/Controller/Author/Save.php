<?php
 
namespace Midwr\Manager\Controller\Author;
 
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\App\Cache\TypeListInterface;
use \Magento\Framework\App\Cache\Frontend\Pool;
use Midwr\Manager\Model\AuthorFactory;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_author;
    protected $_cacheTypeList;
    protected $_cacheFrontendPool;
 
	public function __construct(
		Context $context,
        AuthorFactory $author,
        TypeListInterface $cacheTypeList,
        Pool $cacheFrontendPool
    ) {
        $this->_author = $author;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheFrontendPool = $cacheFrontendPool;
        parent::__construct($context);
    }
	public function execute()
    {
        $data = $this->getRequest()->getParams();
    	$author = $this->_author->create();
        $author->setData($data);
        if($author->save()){
            $this->messageManager->addSuccessMessage(__('You saved the data.'));
            // Clean cache in order to catch changes
            $types = array('block_html','collections', 'full_page');
            foreach ($types as $type) {
                $this->_cacheTypeList->cleanType($type);
            }
            foreach ($this->_cacheFrontendPool as $cacheFrontend) {
                $cacheFrontend->getBackend()->clean();
            }
        }else{
            $this->messageManager->addErrorMessage(__('Data was not saved.'));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('manager/author/add');
        return $resultRedirect;
    }
}