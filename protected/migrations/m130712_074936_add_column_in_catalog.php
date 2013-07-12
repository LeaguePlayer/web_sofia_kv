<?php

class m130712_074936_add_column_in_catalog extends CDbMigration
{
	public function up()
	{
		$this->addColumn('catalog', 'human_count', 'TINYINT');
	}

	public function down()
	{
		$this->dropColumn('catalog', 'human_count');
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