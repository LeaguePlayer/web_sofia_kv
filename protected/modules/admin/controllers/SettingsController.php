<?php

class SettingsController extends AdminController{

	public function actionIndex(){
		$model = Settings::model()->find();

		if(!$model) $model = new Settings;

		if(isset($_POST['Settings'])){
			$model->attributes = $_POST['Settings'];
			
			if($model->id){
				$model = Settings::model()->findByPk($model->id);
			}

			$model->summary = serialize($_POST['Settings']);

			if($model->save()){
				Yii::app()->user->setFlash('success', "Данные сохранены");
			}
		}

		$this->render('index', array('model' => $model));
	}
}