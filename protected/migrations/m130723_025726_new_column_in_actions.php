<?php

class m130723_025726_new_column_in_actions extends CDbMigration
{
	public function up()
	{
		$this->addColumn('action', 'new_price', 'integer default 0');
	}

	public function down()
	{
		$this->dropColumn('action', 'new_price');
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