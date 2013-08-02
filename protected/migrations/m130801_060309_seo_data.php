<?php

class m130801_060309_seo_data extends CDbMigration
{
	public function up()
	{
		//catalog
		$this->addColumn('catalog', 'meta_title', 'varchar(255)');
		$this->addColumn('catalog', 'meta_desc', 'text');
		$this->addColumn('catalog', 'meta_keys', 'varchar(255)');
		$this->addColumn('catalog', 'meta_html', 'text');

		//action
		$this->addColumn('action', 'meta_title', 'varchar(255)');
		$this->addColumn('action', 'meta_desc', 'text');
		$this->addColumn('action', 'meta_keys', 'varchar(255)');
		$this->addColumn('action', 'meta_html', 'text');

		//page
		$this->addColumn('page', 'meta_title', 'varchar(255)');
		$this->addColumn('page', 'meta_desc', 'text');
		$this->addColumn('page', 'meta_keys', 'varchar(255)');
		$this->addColumn('page', 'meta_html', 'text');
	}

	public function down()
	{
		//catalog
		$this->dropColumn('catalog', 'meta_title');
		$this->dropColumn('catalog', 'meta_desc');
		$this->dropColumn('catalog', 'meta_keys');
		$this->dropColumn('catalog', 'meta_html');

		//action
		$this->dropColumn('action', 'meta_title');
		$this->dropColumn('action', 'meta_desc');
		$this->dropColumn('action', 'meta_keys');
		$this->dropColumn('action', 'meta_html');

		//page
		$this->dropColumn('page', 'meta_title');
		$this->dropColumn('page', 'meta_desc');
		$this->dropColumn('page', 'meta_keys');
		$this->dropColumn('page', 'meta_html');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}