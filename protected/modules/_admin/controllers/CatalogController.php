<?php

class CatalogController extends AdminController{

	public function actionIndex(){
		$this->adminMenu = array(
            array('label' => 'Admin Operations'),
            array('label' => 'Все квартиры', 'url' => array('catalog/index')),
            array('label' => 'Demo 1', 'url' => array('demo1')),
        );

		$dataProvider=new CActiveDataProvider('Catalog');

		$this->render('index', array('data'=>$dataProvider));
	}
}