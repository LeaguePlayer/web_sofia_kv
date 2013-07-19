<?php

class CatalogController extends Controller
{

	public function init(){
		parent::init();
	}

	public function actionIndex()
	{
		$model = new Catalog;

		//Default initialization
		$model->human_count = 2;
		$model->price_24 = 800;

		$dataProvider=new CActiveDataProvider('Catalog', array('criteria' => $this->getCriteriaForFilter($model)));
		$areas = Area::model()->findAll(array('order' => 'name'));

		$this->render('index', array(
			'data' => $dataProvider,
			'model' => $model,
			'areas' => $areas
		));
	}

	//Function process POST and return object Criteria for filter items
	private function getCriteriaForFilter(& $model){
		$criteria = new CDbCriteria();

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
						$criteria->addCondition('rooms_count=:rooms_count'.$key, 'OR');
						$criteria->params[':rooms_count'.$key] = $key;
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

		return $criteria;
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

	public function actionMap($id = 0){
		$model = new Catalog;

		//Default initialization
		$model->human_count = 2;
		$model->price_24 = 800;

		$areas = Area::model()->findAll(array('order' => 'name'));

		$this->render('map', array(
			'model' => $model,
			'areas' => $areas
		));
	}

	//ajax Filter from map action and get JSON
	public function actionGetRooms(){
		header('Content-type: application/json');

		$criteria = new CDbCriteria();

		//if recive data from Filter
		if(isset($_POST['Catalog'])){
			$model = new Catalog;
			$criteria = $this->getCriteriaForFilter($model);
		}

		$rooms = Catalog::model()->findAll($criteria);
		foreach ($rooms as $val) {
			$val->desc = strip_tags($val->desc);
		}

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