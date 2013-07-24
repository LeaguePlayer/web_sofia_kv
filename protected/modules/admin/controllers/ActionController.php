<?php

class ActionController extends AdminController
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'sort', 'checkRoom'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Action;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Action']))
		{
			$model->attributes=$_POST['Action'];
			if($model->save()){
				$model->attributes=$_POST['Action'];

				if($model->validate()){
					//Create Gallery
					$gallery = new Gallery();
					$gallery->name = true;
					$gallery->description = true;
					$gallery->versions = array(
					    'big' => array(
		                    'adaptiveResize' => array(712, 430),
		                ),
		                'v1' => array(
		                    'adaptiveResize' => array(240, 133),
		                ),
		                'v2' => array(
		                    'adaptiveResize' => array(235, 290),
		                )
					);
					$gallery->save();

					$model->gallery_id = $gallery->id;
					$model->save(false);

					if(!empty($_POST['addCatItems'])){
						$this->addCatItems($_POST['addCatItems'], $model->id);
					}

					$this->redirect(array('view','id'=>$model->id));
				}
			}
		}

		if($model->date_finish == '0000-00-00') $model->date_finish = "";
		if(!empty($model->date_finish)) $model->date_finish = MyHelper::getFormatedDate('d.m.Y', $model->date_finish);

		$this->render('create',array(
			'model'=>$model,
		));
	}

	//Check room
	/*public function actionCheckRoom($id){
		//header('Content-type:application/json');
		$result = (object) array('errors' => array(), 'response' => array());

		//Магическая ебать в рот функция
		// проверяем привязана ли квартира к акции

		$command = Yii::app()->db->createCommand();

		$actions = $command
			->select('t1.address, t2.name, t2.active')
			->from('catalog as t1, action as t2, catalog_actions')
			->where('t1.id = catalog_id AND t2.id = action_id AND catalog_id = :id', array(':id' => $id))
			->queryAll();
		if(empty($actions)){
			//$result->response[] = 'Квартира не привязана не к одной из акций.';
		}else{
			foreach ($actions as $action) {
				if(intval($action['active']) == 1) $result->errors[] = 'Квартира &laquo;'.$action['address'].'&raquo; привязана к акции - &laquo;'.$action['name'].'&raquo;';
				if(intval($action['active']) == 0) $result->response[] = 'Квартира &laquo;'.$action['address'].'&raquo; привязана к неактивной акции - &laquo;'.$action['name'].'&raquo;';
			}
			
		}

		echo CJSON::encode($result);
		Yii::app()->end();
	}*/

	//get Rooms related on Action
	public function getRoomsAction($id){
		$items = Yii::app()->db->createCommand()
		    ->select('id, address as text')
		    ->from('catalog, catalog_actions')
		    ->where('action_id = :id AND catalog.id = catalog_id', array(':id' => $id))
		    ->queryAll();
		return CJSON::encode($items);
	}

	//Add relation for catalog item
	private function addCatItems($items, $id){
		$command = Yii::app()->db->createCommand();
		foreach ($items as $key => $value) {
			$command->insert('catalog_actions', array(
			    'catalog_id' => $value,
			    'action_id'=>$id,
			));
		}
	}

	//Remove relation for catalog item
	private function removeCatItems($ids, $action_id){
		$command = Yii::app()->db->createCommand();
		foreach ($ids as $key => $value) {
			$command->delete('catalog_actions', 'action_id = :id AND catalog_id = :catalog_id', array(':catalog_id' => $value, ':id' => $action_id));
		}
	}

	/*private function addCatItems($ids, $action_id){
		Catalog::model()->updateByPk($ids, array('action_id' => $action_id));
	}*/

	/*private function removeCatItems($ids){
		Catalog::model()->updateByPk($ids, array('action_id' => 0));
	}*/

	public function actionSort()
	{
	    if (isset($_POST['items']) && is_array($_POST['items'])) {
	        $i = 0;
	        foreach ($_POST['items'] as $item) {
	            $project = Action::model()->updateByPk($item, array('sort' => $i));
	            $i++;
	        }
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Action']))
		{
			$model->attributes=$_POST['Action'];

			if(!empty($_POST['addCatItems'])){
				$this->addCatItems($_POST['addCatItems'], $model->id);
			}
			if(!empty($_POST['removeCatItems'])){
				$this->removeCatItems($_POST['removeCatItems'], $model->id);
			}

			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		if($model->date_finish == '0000-00-00') $model->date_finish = "";
		if(!empty($model->date_finish)) $model->date_finish = MyHelper::getFormatedDate('d.m.Y', $model->date_finish);

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Action');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Action('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Action']))
			$model->attributes=$_GET['Action'];

		$this->render('admin',array(
			'model'=>$model,
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='action-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
