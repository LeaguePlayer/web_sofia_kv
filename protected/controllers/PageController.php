<?php

class PageController extends Controller
{
	public function actionView($alias){
		$this->render('view', array('model' => $this->loadModel($alias)));
	}

	public function loadModel($alias)
	{
		$model=Page::model()->find('alias=:alias', array(':alias' => $alias));
		if($model===null || $model->active == 0)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
