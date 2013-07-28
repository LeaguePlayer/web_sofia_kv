<?php

class m130728_092927_create_page_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('page', 'active', 'TINYINT default 0');
	}

	public function down()
	{
		$this->dropColumn('page', 'active');
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