<?php
 
namespace Midwr\Manager\Setup;
 
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
 
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
 
        $installer->startSetup();
 
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $installer->getConnection()->addColumn(
                $installer->getTable('book_t'),
                'using_upgradeschema',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'nullable' => true,
                    'comment' => 'Using UpgradeSchema'
                ]
            );
            $installer->getConnection()->addColumn(
                $installer->getTable('author_t'),
                'using_upgradeschema',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'nullable' => true,
                    'comment' => 'Using UpgradeSchema'
                ]
            );
        }
 
        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $installer->getConnection()->dropColumn(
                $installer->getTable('book_t'),
                'using_upgradeschema'
                );
            $installer->getConnection()->dropColumn(
                $installer->getTable('author_t'),
                'using_upgradeschema'
                );
        }
        $installer->endSetup();
    }
}