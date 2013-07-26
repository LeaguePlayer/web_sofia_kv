<?php

class ServiceController extends Controller{

	public function actionIndex(){
		$model = new Catalog;
		$areas = Area::model()->findAll(array('order' => 'name'));

		$this->render('index', array(
			'areas' => $areas,
			'model' => $model
		));
	}
}