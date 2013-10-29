<?php

class PublicationController extends Controller
{
	public $layout = '//layouts/admin';

	public function actionIndex(){	
		$this->layout = '//layouts/home';
		$criteria = new CDbCriteria();
       	$criteria->order = 'id DESC';		
		$publication=Publication::model()->findAll($criteria);
		$data['publication']=$publication;
		$this->render('index',$data);
		
	}

	public function actionView($id){
		$this->layout = '//layouts/home';
		$publication=Publication::model()->findByPk($id);
		if(empty($publication)){
			 throw new CHttpException(404,'The specified page cannot be found');
		}
		$data['view'] = $publication;
		$this->render('view',$data);
	}
	
}