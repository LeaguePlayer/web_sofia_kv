<?php

class PromoController extends Controller
{
	public function actionIndex(){

		$model = new Catalog;
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
		$model = new Catalog;
		$criteria = CatalogController::getCriteriaForFilter($model);
		//$criteria->join = 'LEFT JOIN catalog_actions ON action_id=:id';
		$criteria->with = 'cat_actions';
		$criteria->together = true;
		$criteria->addCondition('action_id = :id');
		$criteria->params[':id'] = $id;

		$action_rooms=new CActiveDataProvider('Catalog', array('criteria' => $criteria));

		$areas = Area::model()->findAll(array('order' => 'name'));

		$this->render('view', array(
			'action' => $this->loadModel($id),
			'model' => $model,
			'areas' => $areas,
			'action_rooms' => $action_rooms
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Action::model()->findByPk($id);
		if($model===null || $model->active == 0)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}