<?php

class CatalogController extends AdminController
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
				'actions'=>array('admin','delete', 'sort'),
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
		// configure and save gallery model

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
		$model=new Catalog;
		$areas = Area::model()->findAll();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Catalog']))
		{
			$model->attributes=$_POST['Catalog'];

			//$model->tour_3d=CUploadedFile::getInstance($model,'tour_3d');

			if($model->validate()){
				//Create Gallery
				$gallery = new Gallery();
				$gallery->name = true;
				$gallery->description = true;
				$gallery->versions = array(
				    'v1' => array(
	                    'adaptiveResize' => array(280, 280),
	                ),
	                'v2' => array(
	                    'adaptiveResize' => array(210, 280),
	                ),
	                '_gallery_mini' => array(
	                    'adaptiveResize' => array(200, 200),
	                ),
	                '_gallery_big' => array(
	                    'adaptiveResize' => array(920, 420),
	                ),
	                'medium' => array(
	                    'resize' => array(1200, 1000),
	                )
				);
				$gallery->save();

				$model->gallery_id = $gallery->id;

				$model->save(false);

				//$model->create3dTour();

				if(!empty($_POST['addItems'])){
					$this->addAreasById($_POST['addItems'], $model->id);
				}

				$this->redirect(array('view','id'=>$model->id));
			}
		}

		if(!empty($model->features))
			$model->features = explode(',', $model->features);

		$this->render('create',array(
			'model'=>$model,
			'areas'=>$areas
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
		$areas = Area::model()->findAll();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Catalog']))
		{
			$model->attributes=$_POST['Catalog'];

			if(!empty($_POST['addItems'])){
				$this->addAreasById($_POST['addItems'], $model->id);
			}
			if(!empty($_POST['removeItems'])){
				$this->removeAreasById($_POST['removeItems'], $model->id);
			}

			//$tour_file = CUploadedFile::getInstance($model,'tour_3d');
			//if($tour_file) $model->tour_3d = $tour_file;

			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		
		if(!empty($model->features))
			$model->features = explode(',', $model->features);

		$this->render('update',array(
			'model'=>$model,
			'areas'=>$areas
		));
	}

	//Add relation for catalog item
	private function addAreasById($areas, $id){
		$command = Yii::app()->db->createCommand();
		foreach ($areas as $key => $value) {
			$command->insert('catalog_areas', array(
			    'catalog_id' => $id,
			    'area_id'=>$value,
			));
		}
	}
	//Remove relation for catalog item
	private function removeAreasById($areas, $id){
		$command = Yii::app()->db->createCommand();
		foreach ($areas as $key => $value) {
			$command->delete('catalog_areas', 'area_id=:id', array(':id' => $value));
		}
	}

	//get Rooms related on Action
	public function getItemAreas($id){
		$items = Yii::app()->db->createCommand()
		    ->select('id, name as text')
		    ->from('area, catalog_areas')
		    ->where('catalog_id = :id AND area_id = area.id', array(':id' => $id))
		    ->queryAll();

		return CJSON::encode($items);
	}

	public function actionSort()
	{
	    if (isset($_POST['items']) && is_array($_POST['items'])) {
	        $i = 0;
	        foreach ($_POST['items'] as $item) {
	            $project = Catalog::model()->updateByPk($item, array('sort' => $i));
	            /*$project->sort = $i;
	            $project->save();*/
	            $i++;
	        }
	    }
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
		$dataProvider=new CActiveDataProvider('Catalog');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Catalog('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Catalog']))
			$model->attributes=$_GET['Catalog'];

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
		$model=Catalog::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='catalog-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
