<?php

class m131009_071312_fk_added_gall_album extends CDbMigration
{
	public function up()
	{
		$this->addColumn('gallery', 'album_id', 'int(11) NOT NULL AFTER `id`');
		$this->addForeignkey('gafk','gallery','album_id','album','id','CASCADE','CASCADE');
	}

	public function down()
	{
		echo "m131009_071312_fk_added_gall_album does not support migration down.\n";
		return false;
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