<?php

class AlbumController extends Controller
{
	public $layout = '//layouts/admin';
	/**
	 * Declares class-based actions.
	 */

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	/*public function actionIndex()
	{
		$this->render('index');
	}*/

	public function actionShow(){
		$this->layout = '//layouts/home';		
		$criteria = new CDbCriteria();          
        $criteria->condition ='status = 1';
        $criteria->order = 'id DESC';
		$new_page = Album::model()->findAll($criteria);
		$album_data=array();
		if(empty($new_page)){
			 throw new CHttpException(404,'The specified page cannot be found');
		}
		foreach($new_page as $page){
			$gallery_data[]=$page->attributes;						
		}
		$data['show']=$album_data;		
		$this->render('show',$data);
	}
}