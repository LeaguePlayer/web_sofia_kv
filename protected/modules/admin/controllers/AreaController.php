<?php

class AreaController extends AdminController
{

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index', 'getAreas'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		// $dataProvider=new CActiveDataProvider('Area');
		if(Yii::app()->request->isAjaxRequest){
			$data = CJSON::decode(Yii::app()->request->getRawBody());
			if(!empty($data['Areas'])){
				foreach ($data['Areas'] as $value) {
					$model = new Area;
					
					//if destroy
					if(isset($value['_destroy'])){
						$this->loadModel($value['id'])->delete();
						continue;
					}

					//If exist
					if(!empty($value['id'])){
						$model=$this->loadModel($value['id']);
					}

					$model->attributes=$value;
					$model->save();
				}				
			}
			Yii::app()->end();
		}

		$model = new Area;
		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function actionGetAreas(){
		header('Content-type:application/json');
		echo CJSON::encode(Area::model()->findAll());
		Yii::app()->end();	
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Area::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='area-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
