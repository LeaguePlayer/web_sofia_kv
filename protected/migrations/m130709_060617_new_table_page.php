<?php

class m130709_060617_new_table_page extends CDbMigration
{
	public function up()
	{
		$this->createTable('page', array(
            'id' => 'pk',
            'title' => 'string NOT NULL',
            'alias' => 'string',
            'content' => 'text',
        ), 'ENGINE = MYISAM');
	}

	public function down()
	{
		$this->dropTable('page');
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