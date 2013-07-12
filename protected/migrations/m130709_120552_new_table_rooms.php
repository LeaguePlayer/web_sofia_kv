<?php

class m130709_120552_new_table_rooms extends CDbMigration
{
	public function up()
	{
		$this->createTable('catalog', array(
            'id' => 'pk',
            'address' => 'string NOT NULL',
            'number' => 'int not null',
            'desc' => 'text',
            'features' => 'string',
            'price_24' => 'int',
            'price_night' => 'int',
            'price_hour' => 'int',
            'active' => 'TINYINT',
            'preview' => 'int',
            'area' => 'int'
        ));
	}

	public function down()
	{
		$this->dropTable('catalog');
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