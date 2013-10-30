<?php

class m131029_060008_add_content_publication extends CDbMigration
{
	public function up()
	{
		$this->addColumn('publication', 'content', 'text AFTER `name`');
	}

	public function down()
	{
		echo "m131029_060008_add_content_publication does not support migration down.\n";
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