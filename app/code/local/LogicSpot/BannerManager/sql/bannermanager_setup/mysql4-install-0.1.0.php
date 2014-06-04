<?php
 
$installer = $this;

$installer->startSetup();

$table1 = $installer->getConnection()->newTable($installer->getTable('bannermanager/banner'))
    ->addColumn('banner_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'auto_increment' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true,
	), 'Banner ID')
    ->addColumn('image', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => false,
	), 'Image')
    ->addColumn('date_from', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
	), 'Date From')
    ->addColumn('date_to', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
	), 'Date To')
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
	), 'Title')
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
	), 'Content')
    ->addColumn('primary_colour', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
	), 'Primary Colour')
    ->addColumn('secondary_colour', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
	), 'Secondary Colour')
    ->addColumn('store_view', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
	), 'Store View')
    ->addColumn('group_id', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
	), 'Group Id')
    ->addColumn('link', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
	), 'Link')
    ->addColumn('priority', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
	), 'Priority');

$installer->getConnection()->createTable($table1);

$table2 = $installer->getConnection()->newTable($installer->getTable('bannermanager/group'))
    ->addColumn('group_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'auto_increment' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true,
	), 'Group ID')
    ->addColumn('identifier', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => false,
	), 'Identifier')
    ->addColumn('init_script', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
	), 'init_script')
	->addColumn('sort_type', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
	), 'sort_type')
    ->addColumn('max_banners', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
	), 'max_banners');

$installer->getConnection()->createTable($table2);

$installer->endSetup();
