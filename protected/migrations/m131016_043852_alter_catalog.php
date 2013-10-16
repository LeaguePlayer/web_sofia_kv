<?php

class m131016_043852_alter_catalog extends CDbMigration
{
	public function up()
	{
		$this->addColumn('catalog', 'tour_3d', 'string');
	}

	public function down()
	{
		$this->dropColumn('catalog', 'tour_3d');
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