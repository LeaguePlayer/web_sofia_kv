<?php

class PromoController extends Controller
{
	public function actionIndex(){

		$model = new Catalog;
		$model->price_24 = 1000;
		$criteria = new CDbCriteria();

		$criteria->addCondition('active=1');
		$criteria->order = 'sort';

		$action = Action::model()->find($criteria);

		$areas = Area::model()->findAll(array('order' => 'name'));

		$this->render('index',array(
			'model' => $model,
			'areas' => $areas,
		));
	}

	public function actionView($id){
		$promo = $this->loadModel($id);

		$model = new Catalog;
		$model->price_24 = 1000;
		$criteria = CatalogController::getCriteriaForFilter($model);
		//$criteria->join = 'LEFT JOIN catalog_actions ON action_id=:id';
		$criteria->with = 'cat_actions';
		$criteria->together = true;
		$criteria->addCondition('action_id = :id');
		$criteria->params[':id'] = $id;

		$action_rooms=new CActiveDataProvider('Catalog', array('criteria' => $criteria));

		//Check fixed price
		$fixed = false;
		$fixed_price = null;

		foreach ($action_rooms->getData() as $value) {
			if(!$fixed_price) {
				$fixed_price = $value->price_24;
				$fixed = true;
			}
			else $fixed = $fixed && ($fixed_price == $value->price_24);
		}
		if(!$fixed) {
			$fixed_price = null;
		}
		
		$areas = Area::model()->findAll(array('order' => 'name'));

		//seo
		$this->addMetaTags($promo, 'name');

		$this->breadcrumbs=array(
  			'Специальные предложения'
		);
		$this->render('view', array(
			'action' => $promo,
			'model' => $model,
			'areas' => $areas,
			'action_rooms' => $action_rooms,
			'fixed_price' => $fixed_price
		));
	}



	public function loadModel($id)
	{
		$model=Action::model()->findByPk($id);
		if($model===null || $model->active == 0)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}