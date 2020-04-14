<?php
 
namespace Midwr\Manager\Setup;
 
use \Magento\Framework\Setup\InstallDataInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use Midwr\Manager\Model\Book;
use Midwr\Manager\Model\Author;

class InstallData implements InstallDataInterface
{
    protected $_bookFactory;
    protected $_authorFactory;
 
    public function __construct
    (
        Book $bookFactory,
        Author $authorFactory
    )
    {
        $this->_bookFactory = $bookFactory;
        $this->_authorFactory = $authorFactory;
    }
 
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $dataBook = [
            'title' => 'LibroInstall',
            'author' => 'Fabian',
            'content' => 'asdbghytjrgfsdf',
            'created_at' => date('Y-m-d G:i:s')
        ];
        $post = $this->_bookFactory->create();
        $post->addData($dataBook)->save();

        $dataAuthor = [
            'name' => 'Pablo',
            'books' => 190,
            'telephone' => '8888888',
        ];
        $post = $this->_authorFactory->create();
        $post->addData($dataAuthor)->save();
    }
}