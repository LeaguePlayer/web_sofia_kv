<?php

class m130711_095538_add_column_in_catalog_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('catalog', 'gallery_id', 'integer');
	}

	public function down()
	{
		$this->dropColumn('catalog', 'gallery_id');
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