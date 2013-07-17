<?php

class m130712_082304_new_table_action extends CDbMigration
{
	public function up()
	{
		$this->createTable('action', array(
            'id' => 'pk',
            'name' => 'string NOT NULL',
            'active' => 'TINYINT',
            'short_desc' => 'varchar(150)',
            'long_desc' => 'text',
            'date_create' => 'date',
            'date_finish' => 'date',
            'gallery_id' => 'int',
            'sort' => 'int default 100'
        ), 'ENGINE = MYISAM');
	}

	public function down()
	{
		$this->dropTable('action');
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