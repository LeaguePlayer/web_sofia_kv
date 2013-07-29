<?php

class m130729_084738_service_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('service', array(
            'id' => 'pk',
            'category' => 'string',
            'link' => 'string',
            'link_text' => 'string',
        ), 'ENGINE = MYISAM');
	}

	public function down()
	{
		$this->dropTable('service');
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