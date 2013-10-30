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
		$criteria->alias = 'g';  
        $criteria->condition ='g.is_active = 1 AND g.album_id='.$id;
        $criteria->order = 'g.id DESC';
		$new_page = Gallery::model()->findAll($criteria);
		$album=Album::model()->findByAttributes(array('id'=>$id));
		$album_name=$album->attributes['album_name'];
		
		if(empty($new_page)){
			 throw new CHttpException(404,'The specified page cannot be found');
		}
		
		$data['view']=$new_page;
		$data['album_name']=$album_name;
		$this->render('view',$data);
	}
}