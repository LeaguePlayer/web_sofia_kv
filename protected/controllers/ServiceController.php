<?php

class ServiceController extends Controller{

	public function actionIndex(){
		$model = new Catalog;
		$areas = Area::model()->findAll(array('order' => 'name'));

		$links = Service::model()->findAll(array('order' => 'category'));

		$this->render('index', array(
			'areas' => $areas,
			'model' => $model,
			'links' => $links
		));
	}
}