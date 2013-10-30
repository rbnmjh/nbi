<?php

class m131017_101244_album_image extends CDbMigration
{
	public function up()
	{
		$this->addColumn('album', 'image_name', 'varchar(250) NULL AFTER `album_name`');
	}

	public function down()
	{
		echo "m131017_101244_album_image does not support migration down.\n";
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