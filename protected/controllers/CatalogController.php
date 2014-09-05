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
		$model->human_count = 1;
		$model->price_24 = 300;

		$dataProvider=new CActiveDataProvider('Catalog', array(
			'criteria' => $this->getCriteriaForFilter($model),
			'pagination' => false
		));

		$areas = Area::model()->findAll(array('order' => 'name'));

		$this->breadcrumbs=array(
  			'Каталог квартир'
		);
		$this->render('index', array(
			'data' => $dataProvider,
			'model' => $model,
			'areas' => $areas
		));
	}

	//Function process POST and return object Criteria for filter items
	public static function getCriteriaForFilter(& $model){
		$criteria = new CDbCriteria();

		//only active
		$criteria->addCondition('t.active=1');
		//sort field
		$criteria->order = 't.rooms_count, t.sort';

        $filterParams = Yii::app()->request->isPostRequest ? $_POST : $_GET;

		//Fucking filter
		if(isset($filterParams['Catalog'])){
			$model->attributes = $filterParams['Catalog'];

			if(isset($filterParams['area']) && $filterParams['area'] != '0'){
				$criteria->with = array('cat_areas');
				$criteria->together = true;
				$criteria->addCondition('area_id=:area_id');
				$criteria->params[':area_id'] = $filterParams['area'];
			}

			if(!empty($filterParams['Catalog']['rooms_count'])){
				$items = $filterParams['Catalog']['rooms_count'];

				$flag = false;
				foreach ($items as $key => $value) {
					if($value != 0){
						if (!$flag)
							$criteria->addCondition('rooms_count=:rooms_count'.$key);
						else
							$criteria->addCondition('rooms_count=:rooms_count'.$key, 'OR');
						$criteria->params[':rooms_count'.$key] = $key;
						$flag = true;
					}
				}
			}

			if(isset($filterParams['Catalog']['human_count']) && $filterParams['Catalog']['human_count'] != 0){
				$criteria->addCondition('human_count >= :human_count');
				$criteria->params[':human_count'] = $filterParams['Catalog']['human_count'];
			}

			if(isset($filterParams['Catalog']['price_24']) && $filterParams['Catalog']['price_24'] != 0){
				$criteria->addCondition('price_24 >= :price_24');
				$criteria->params[':price_24'] = $filterParams['Catalog']['price_24'];
			}
			
			if(!empty($filterParams['Catalog']['features'])){
				$items = $filterParams['Catalog']['features'];
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

		$room = $this->loadModel($id);

		//similar items
		$criteria = new CDbCriteria();
		$criteria->limit = 4;

		//price between -300 and + 300 rub
		$criteria->addCondition('price_24 >= :min AND price_24 <= :max');
		$criteria->addCondition('t.id != :id');
		$criteria->params = array(
			':min' => $room->price_24 - 300, 
			':max' => $room->price_24 + 300,
			':id' => $room->id
		);

		$action = Action::model()->find('active=1');

		$dataProvider=new CActiveDataProvider('Catalog', array('criteria' => $criteria));

		//seo
		$this->addMetaTags($room, 'address');

		$model = $this->loadModel($id);
		$this->breadcrumbs=array(
  			'Каталог квартир' => 'index',
  			CHtml::encode($model->rooms_count)."-комнатная квартира, ".CHtml::encode($model->address),
		);
		$this->render('view', array(
			'model' => $model,
			'data' => $dataProvider,
			'action' => $action
		));
	}

	public function actionMap($id = 0){
		$model = new Catalog;

		//Default initialization
		$model->human_count = 2;
		$model->price_24 = 800;

		$areas = Area::model()->findAll(array('order' => 'name'));

		$action = Action::model()->find('active=1');

		$this->breadcrumbs=array(
  			'Квартиры на карте'
		);
		$this->render('map', array(
			'model' => $model,
			'areas' => $areas,
			'action' => $action
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
		if($model===null && $model->active == 1)
			throw new CHttpException(404,'Страница не найдена.');
		return $model;
	}

	public function actionSendForm(){
		$model = new BookingForm;

		if(isset($_POST['BookingForm'])){

			$model->attributes = $_POST['BookingForm'];

			if($model->validate()){
				echo "ok";
				Catalog::sendSMSLight(Settings::getPhone(), $_POST['subject'], 'sofia72.ru');

				$msg = $this->renderPartial('_mail_template', array('model' => $model), true);
				$this->sendMail(Settings::getEmail(), $_POST['subject'], $msg, $model);
			}else{
				Yii::app()->clientScript->scriptMap['jquery.js'] = false;
				Yii::app()->clientScript->scriptMap['jquery-ui.js'] = false;
				if(!isset($_POST['main']))
					$this->renderPartial('_booking_form', array('ajax' => true, 'model' => $model));
				else
					$this->renderPartial('/site/_booking_form_main', array('ajax' => true, 'model' => $model));
			}
			Yii::app()->end();	
		}
		//$this->renderPartial('/site/_booking_form_main', array('ajax' => true, 'model' => $model));
		Yii::app()->end();
	}

	public function actionFancyForm(){
		$model = new BookingForm;

		$model->human_count = 1;
		$model->rooms_count = 1;
		$model->days = 1;

		if(isset($_POST['BookingForm'])){

			$model->attributes = $_POST['BookingForm'];

			if($model->validate()){
				echo "ok";
				Catalog::sendSMSLight(Settings::getPhone(), $_POST['subject'], 'sofia72.ru');
				//$this->renderPartial('_mail_template', array('model' => $model));
				$msg = $this->renderPartial('_mail_template', array('model' => $model), true);
				$this->sendMail(Settings::getEmail(), $_POST['subject'], $msg, $model);
				Yii::app()->end();
			}
			else{
				//ii::app()->clientScript->corePackages = array();
			}
			
		}

		if($model->id)
			$this->renderPartial('_booking_room', array('model' => $model, 'ajax' => true, 'room' => Catalog::model()->findByPk($model->id)));
		else
			$this->renderPartial('_fancy_form', array('model' => $model, 'ajax' => true));
		//$this->renderPartial('/site/_booking_form_main', array('ajax' => true, 'model' => $model));
		Yii::app()->end();
	}

	public function actionFancyFormCall(){
		$model = new CallForm;

		if(isset($_POST['CallForm'])){

			$model->attributes = $_POST['CallForm'];

			if($model->validate()){
				echo "ok";
				$subject = 'Поступил заказ звонка sofia72.ru';
				Catalog::sendSMSLight(Settings::getPhone(), $subject, 'sofia72.ru');
				//$this->renderPartial('_mail_template', array('model' => $model));
				$msg = $this->renderPartial('_mail_call_template', array('model' => $model), true);
				$this->sendMail(Settings::getEmail(), $subject, $msg, $model);
				Yii::app()->end();
			}
			else{
				//ii::app()->clientScript->corePackages = array();
			}
			
		}

		$this->renderPartial('_fancy_form_call', array('model' => $model, 'ajax' => true));
		//$this->renderPartial('/site/_booking_form_main', array('ajax' => true, 'model' => $model));
		Yii::app()->end();
	}

	private function sendMail($to, $subject, $message, $form){
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

		// Additional headers
		//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
		if (isset($form->email)) {
			if($form->fio) $headers .= 'From: '.$form->fio.' <'.$form->email.'>' . "\r\n";
			else $headers .= 'From: Гость <'.$form->email.'>' . "\r\n";
		}
		else {
			$headers .= 'From: Гость <call-request@sofia72.ru>' . "\r\n";
		}

		// Mail it
		mail($to, $subject, $message, $headers);
	}

	public function actionGetTour($swf){
		$ar = explode('/', $swf);
		if(count($ar) > 1)  $ar = array_reverse($ar);
		$file = YiiBase::getPathOfAlias('webroot').DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR."tours".DIRECTORY_SEPARATOR.$ar[0];

		header('Content-type: application/x-shockwave-flash');

		//print_r($file);
		echo file_get_contents($file);

		//Yii::app()->request->sendFile($file, base64_encode($file), 'x-shockwave-flash');
		Yii::app()->end();
	}
}