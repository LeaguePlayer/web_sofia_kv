<?php

class m130712_052707_drop_column_in_catalog extends CDbMigration
{
	public function up()
	{
		$this->dropColumn('catalog', 'preview');
	}

	public function down()
	{
		$this->addColumn('catalog', 'preview', 'integer');	
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