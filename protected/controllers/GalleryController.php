<?php

class GalleryController extends Controller
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

	
	
		/*public function actionPages($slug){
			$this->layout = '//layouts/home';
			$menu_page = Page::model()->findByAttributes(array('slug'=>$slug));			
			$data['page']=$menu_page->attributes;
			$this->render('menu',$data);
		}*/

	public function actionView($id){
		$this->layout = '//layouts/home';
		$criteria = new CDbCriteria();          
        $criteria->condition ='is_active = 1 AND album_id='.$id;
        $criteria->order = 'id DESC';
		$new_page = Gallery::model()->findAll($criteria);
		$gallery_data=array();
		
		if(empty($new_page)){
			 throw new CHttpException(404,'The specified page cannot be found');
		}
		foreach($new_page as $page){
			$gallery_data[]=$page->attributes;						
		}
		$data['view']=$gallery_data;
		
		$this->render('view',$data);
	}
}