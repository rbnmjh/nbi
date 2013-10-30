<?php

class m131029_153928_add_initial_data extends CDbMigration
{
	public function up()
	{
        $this->insert('user', array('first_name'=>'admin','last_name'=>'nbi','email'=>'admin@weblitzstudios.com','password'=>'a753f65c4fe4e5ed119a95bc19a00c47','role'=>'admin','is_active'=>1));
        $this->insert('page', array('page'=>'about us','page_title'=>'About Us','slug'=>'about-us','content'=>'About us content...'));
        $this->insert('page', array('page'=>'activities','page_title'=>'Activities','slug'=>'activities','content'=>'activities content...'));
        $this->insert('page', array('page'=>'services','page_title'=>'Services','slug'=>'services','content'=>'services content...'));
        $this->insert('page', array('page'=>'partners','page_title'=>'Partners','slug'=>'partners','content'=>'partnerscontent...'));
        $this->insert('page', array('page'=>'csr','page_title'=>'Corporate Social Responsibility','slug'=>'csr','content'=>'orporate Social Responsibility content...'));
	}

	public function down()
	{
		echo "m131029_153928_add_initial_data does not support migration down.\n";
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