<?php

class PageController extends Controller
{
	public function actionView($alias){
		$model = $this->loadModel($alias);

		//seo
		$this->addMetaTags($model, 'title');

		$this->render('view', array('model' => $model));
	}

	public function loadModel($alias)
	{
		$model=Page::model()->find('alias=:alias', array(':alias' => $alias));
		if($model===null || $model->active == 0)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
