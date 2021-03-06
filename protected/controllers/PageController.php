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

	/****
		* contact us pages	
	*/
		public function actionView($slug){
			$this->layout = '//layouts/home';
			$menu_page = Page::model()->findByAttributes(array('slug'=>$slug));			
			
			if(empty($menu_page)){
			 throw new CHttpException(404,'The specified page cannot be found');
		}
			$data['page']=$menu_page->attributes;
			$this->render('menu',$data);
		}

		
}