<?php

class PageController extends Controller
{
	public $layout = '//layouts/admin';
	/**
	 * Declares class-based actions.
	 */

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->render('index');
	}

	/*
	 * add page
	 */
	public function actionAddPage()
	{
		
		$this->render('add_page');
	}
}