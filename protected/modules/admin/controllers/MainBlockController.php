<?php

class MainBlockController extends AdminController
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','view', 'getItems', 'delete'),
				'users'=>array('admin'),
			),
			/*array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),*/
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
		$model=new MainBlock;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MainBlock']))
		{
			$model->attributes=$_POST['MainBlock'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['MainBlock']))
		{
			$model->attributes=$_POST['MainBlock'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

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
		$model = $this->loadModel($id);
		$model->removeImages();
		$model->delete();

		$this->redirect(array('index'));
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		/*if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));*/
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

		//$dataProvider=new CActiveDataProvider('MainBlock');
		$models = array();

		$blocks = MainBlock::model()->findAll(array('order' => 'sort'));
		$start = (count($blocks) > 0 ? count($blocks) : 0);

		for($i = $start; $i < MainBlock::LIMIT; $i++) 
			$models[$i] = new MainBlock;

		if(isset($_POST['MainBlock'])){

			foreach ($_POST['MainBlock'] as $key => $value) {
				$model = '';

				//if(!isset($models[$key]) && !isset($value['id'])) { print_r($_POST['MainBlock']); print_r($key); die();}
				if(isset($value['id'])) {
					$model = MainBlock::model()->findByPk($value['id']);
					$model->attributes = $value;
				}
				else {
					$model = $models[$key];
					$model->attributes = $value;
				}

				//print_r($_POST['MainBlock']); die();
				
				$old_image = $model->preview;
				$model->preview = CUploadedFile::getInstance($model, "[$key]preview");	

				if($model->validate()){

					if($model->preview){
						if(isset($model->id)) $model->removeImages();

						$image = $model->preview;
						$upload_dir = MainBlock::getUploadPath();

						//save image
						$filename = md5($image->getName().time()).'.'.$image->getExtensionName();
						
						//$temp = Yii::app()->phpThumb->create($image->getTempName());
						Yii::app()->phpThumb->create($image->getTempName())
							->adaptiveResize(1000, 800)->save($upload_dir.DIRECTORY_SEPARATOR.$filename);
						Yii::app()->phpThumb->create($image->getTempName())
							->adaptiveResize(712, 430)->save($upload_dir.DIRECTORY_SEPARATOR.'big'.$filename);
						Yii::app()->phpThumb->create($image->getTempName())
							->adaptiveResize(240, 133)->save($upload_dir.DIRECTORY_SEPARATOR.'small'.$filename);
						Yii::app()->phpThumb->create($image->getTempName())
							->adaptiveResize(250, 250)->save($upload_dir.DIRECTORY_SEPARATOR.'admin'.$filename);

						$model->preview = $filename;
					}
					else $model->preview = $old_image;
					
					$model->save(false);
					//print_r($image->tempName);
				}
			}
			$this->redirect('index');
		}

		$this->render('index',array(
			'models'=>$models,
			'blocks'=>$blocks
		));
	}

	public function actionGetItems($model)
	{
		header("Content-Type: application/json");
		$items = array(0 => array('id' => 0, 'text' => 'Не выбрано'));

		switch ($model) {
			case 'Catalog':
				$items = array_merge($items, Yii::app()->db->createCommand()
				    ->select('id, address as text')
				    ->from('catalog')
				    ->where('active=1')
				    ->queryAll());
				break;
			case 'Action':
				$items = array_merge($items, Yii::app()->db->createCommand()
				    ->select('id, name as text')
				    ->from('action')
				    ->where('active=1')
				    ->queryAll());
				break;
			case 'Page':
				$items = array_merge($items, Yii::app()->db->createCommand()
				    ->select('id, title as text')
				    ->from('page')
				    ->where('active=1')
				    ->queryAll());
				break;
		}

		echo CJSON::encode($items);

		Yii::app()->end();
	}	

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new MainBlock('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MainBlock']))
			$model->attributes=$_GET['MainBlock'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return MainBlock the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=MainBlock::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param MainBlock $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='main-block-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
