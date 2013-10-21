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
		public function actionPages($slug){
			$this->layout = '//layouts/home';
			$menu_page = Page::model()->findByAttributes(array('slug'=>$slug));			
			$data['page']=$menu_page->attributes;
			$this->render('menu',$data);
		}

		public function actionNews($id){
			$this->layout = '//layouts/home';
			$new_page = News::model()->findByAttributes(array('id'=>$id,'status'=>'1'));			
			if(empty($new_page)){
				 throw new CHttpException(404,'The specified page cannot be found');
			}
			$data['page']=$new_page->attributes;
			$this->render('news',$data);
		}


		public function actionBlogs($id){
			$this->layout = '//layouts/home';
			$new_page = Blog::model()->findByAttributes(array('id'=>$id,'status'=>'1'));			
			if(empty($new_page)){
				 throw new CHttpException(404,'The specified page cannot be found');
			}
			$data['page']=$new_page->attributes;
			$this->render('blogs',$data);
		}
}