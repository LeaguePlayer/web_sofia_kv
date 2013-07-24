<?php

class m130722_103657_create_action_items_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('catalog_actions', array(
            'catalog_id' => 'int',
            'action_id' => 'int'
        ), 'ENGINE = MYISAM');
        $this->dropColumn('catalog', 'action_id');

        $this->addPrimaryKey('pk', 'catalog_actions', 'catalog_id, action_id');
	}

	public function down()
	{
		$this->dropTable('catalog_actions');
		$this->addColumn('catalog', 'action_id', 'INT default 0');
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