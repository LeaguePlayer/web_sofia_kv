<?php

class m140903_103014_benefit extends CDbMigration
{
	public function up()
	{
		$this->createTable('benefit', array(
            'id' => 'pk',
            'title' => 'string',
            'icon' => 'integer',
            'text' => 'text',
        ), 'ENGINE = MYISAM');
	}

	public function down()
	{
		$this->dropTable('benefit');
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