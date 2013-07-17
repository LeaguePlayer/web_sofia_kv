<?php

class PromoController extends Controller
{
	public function actionIndex(){

		$model = new Catalog;
		$criteria = new CDbCriteria();

		$areas = Area::model()->findAll(array('order' => 'name'));

		$this->render('index',array(
			'model' => $model,
			'areas' => $areas
		));
	}
}