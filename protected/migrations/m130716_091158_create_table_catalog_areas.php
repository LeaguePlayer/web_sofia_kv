<?php

class m130716_091158_create_table_catalog_areas extends CDbMigration
{
	public function up()
	{
		$this->createTable('catalog_areas', array(
            'catalog_id' => 'int',
            'area_id' => 'int'
        ), 'ENGINE = MYISAM');

        $this->addPrimaryKey('pk', 'catalog_areas', 'catalog_id, area_id');
	}

	public function down()
	{
		$this->dropTable('catalog_areas');
	}
}