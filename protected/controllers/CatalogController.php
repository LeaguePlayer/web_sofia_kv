<?php

class CatalogController extends Controller
{

	public function init(){
		parent::init();

		
	}

	public function actionIndex()
	{
		$model = new Catalog;
		$criteria = new CDbCriteria();

		//Default initializtion
		$model->human_count = 2;
		$model->price_24 = 800;

		//Fucking filter
		if(isset($_POST['Catalog'])){
			$model->attributes = $_POST['Catalog'];

			if(isset($_POST['area']) && $_POST['area'] != 0){
				$criteria->with = array('cat_areas');
				$criteria->together = true;
				$criteria->addCondition('area_id=:area_id');
				$criteria->params[':area_id'] = $_POST['area'];
			}

			if(!empty($_POST['Catalog']['rooms_count'])){
				$items = $_POST['Catalog']['rooms_count'];
				foreach ($items as $key => $value) {
					if($value != 0){
						$criteria->addCondition('rooms_count=:rooms_count');
						$criteria->params[':rooms_count'] = $key;
					}
				}
			}

			if(isset($_POST['Catalog']['human_count']) && $_POST['Catalog']['human_count'] != 0){
				$criteria->addCondition('human_count >= :human_count');
				$criteria->params[':human_count'] = $_POST['Catalog']['human_count'];
			}

			if(isset($_POST['Catalog']['price_24']) && $_POST['Catalog']['price_24'] != 0){
				$criteria->addCondition('price_24 >= :price_24');
				$criteria->params[':price_24'] = $_POST['Catalog']['price_24'];
			}
			
			if(!empty($_POST['Catalog']['features'])){
				$items = $_POST['Catalog']['features'];
				foreach ($items as $key => $value) {
					if($value != 0){
						$criteria->addSearchCondition('features', $value);
					}
				}
			}
		}

		$dataProvider=new CActiveDataProvider('Catalog', array('criteria' => $criteria));
		$areas = Area::model()->findAll(array('order' => 'name'));

		$this->render('index', array(
			'data' => $dataProvider,
			'model' => $model,
			'areas' => $areas
		));
	}

	public function actionView($id){

		//similar items
		$criteria = new CDbCriteria();
		$criteria->limit = 4;

		$dataProvider=new CActiveDataProvider('Catalog', array('criteria' => $criteria));

		$this->render('view', array(
			'model' => $this->loadModel($id),
			'data' => $dataProvider
		));
	}

	public function actionMap(){
		$model = new Catalog;
		$areas = Area::model()->findAll(array('order' => 'name'));

		$this->render('map', array(
			'model' => $model,
			'areas' => $areas
		));
	}

	public function actionGetRooms(){
		header('Content-type: application/json');

		$rooms = Catalog::model()->findAll();
		
		echo CJSON::encode($rooms);
		Yii::app()->end();
	}

	public function loadModel($id)
	{
		$model=Catalog::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Страница не найдена.');
		return $model;
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}