<?php

class m130724_033442_add_main_block extends CDbMigration
{
	public function up()
	{
		$this->createTable('main_block', array(
			'id' => 'pk',
            'model' => 'varchar(100)',
            'model_id' => 'int',
            'preview' => 'string',
            'sort' => 'int default 10'
        ), 'ENGINE = MYISAM');
	}

	public function down()
	{
		$this->dropTable('main_block');
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