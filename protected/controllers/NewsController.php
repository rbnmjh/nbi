<?php

class NewsController extends Controller
{
	public $layout = '//layouts/admin';
	/**
	 * Declares class-based actions.
	 */

	

	public function actionView($id){

		$this->layout = '//layouts/home';
		$new_page = News::model()->findByAttributes(array('id'=>$id,'status'=>'1'));	
		if(empty($new_page)){
			 throw new CHttpException(404,'The specified page cannot be found');
		}
		
		$data['news']=$new_page;
		$this->render('view',$data);
	}
}