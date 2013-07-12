<?php

class m130711_164827_add_column_in_catalog extends CDbMigration
{
	public function up()
	{
		$this->addColumn('catalog', 'rooms_count', 'TINYINT');
	}

	public function down()
	{
		$this->dropColumn('catalog', 'rooms_count');
	}

}