<?php

class m131008_093733_add_slug_page extends CDbMigration
{
	public function up()
	{
		$this->addColumn('page', 'slug', 'VARCHAR(250) AFTER `page_title`');
	}

	public function down()
	{
		echo "m131008_093733_add_slug_page does not support migration down.\n";
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