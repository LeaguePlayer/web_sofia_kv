<?php

class m130710_115220_new_table_area extends CDbMigration
{
	public function up()
	{
		$this->createTable('area', array(
            'id' => 'pk',
            'name' => 'string NOT NULL',
        ));
	}

	public function down()
	{
		$this->dropTable('area');
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