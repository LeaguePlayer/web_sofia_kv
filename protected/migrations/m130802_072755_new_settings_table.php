<?php

class m130802_072755_new_settings_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('settings', array(
            'id' => 'pk',
            'summary' => 'text',
        ), 'ENGINE = MYISAM');
	}

	public function down()
	{
		$this->dropTable('settings');
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