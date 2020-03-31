<?php
 
namespace Midwr\Manager\Setup;
 
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
		$installer = $setup;
		$installer->startSetup();
 
		/**
		 * Creating table book
		 */
		$table = $installer->getConnection()->newTable(
			$installer->getTable('book_t')
		)->addColumn(
			'book_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
			'Book Id'
		)->addColumn(
			'title',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true],
			'Title'
		)->addColumn(
			'author',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'Author'
		)->addColumn(
			'content',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			'2M',
			['nullable' => true,'default' => null],
			'Content'
		)->addColumn(
			'created_at',
			\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
			null,
			['nullable' => false],
			'Created At'
		)->setComment(
            'Book Table'
		);
		$installer->getConnection()->createTable($table);

		/**
		 * Creating table author
		 */
		$table = $installer->getConnection()->newTable(
			$installer->getTable('author_t')
		)->addColumn(
			'author_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
			'Author Id'
		)->addColumn(
			'name',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true],
			'Name'
		)->addColumn(
            'books',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			['nullable' => false, 'unsigned' => true],
			'Books'
		)->addColumn(
			'telephone',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true],
			'Telephone'
		)->setComment(
            'Author Table'
		);	

		$installer->getConnection()->createTable($table);
		$installer->endSetup();
	}
}