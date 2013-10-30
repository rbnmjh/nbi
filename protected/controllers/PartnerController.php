<?php

class PartnerController extends Controller
{
	var $layout = '//layouts/home';
	public function actionIndex()
	{
		$partner=Partner::model()->findall();
		$data['partner']=$partner;
		$this->render('index',$data);
	}

	
}