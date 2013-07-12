<?php

class m130712_103257_add_column_in_catalog extends CDbMigration
{
	public function up()
	{
		$this->addColumn('catalog', 'action_id', 'TINYINT default 0');
	}

	public function down()
	{
		$this->dropColumn('catalog', 'action_id');
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