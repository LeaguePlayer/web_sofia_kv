<?php

class m130718_090603_new_column_catalog extends CDbMigration
{
	public function up()
	{
		$this->addColumn('catalog', 'coords', 'varchar(100) NOT NULL');
		$this->addColumn('catalog', 'sort', 'integer default 100');
	}

	public function down()
	{
		$this->dropColumn('catalog', 'coords');
		$this->dropColumn('catalog', 'sort');
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