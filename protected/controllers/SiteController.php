<?php

class SiteController extends Controller
{
	public $layout = "//layouts/home";

	//public $count;

	public $city_block_rooms;
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

		$mainRooms = array();

		//one flat
		$criteria1 = new CDbCriteria();
		$criteria1->addCondition('rooms_count=1');
		$criteria1->limit = 2;

		$mainRooms[] = Catalog::model()->findAll($criteria1);

		//two flat
		$criteria2 = new CDbCriteria();
		$criteria2->addCondition('rooms_count=2');
		$criteria2->limit = 2;

		$mainRooms[] = Catalog::model()->findAll($criteria2);

		//three flat
		$criteria3 = new CDbCriteria();
		$criteria3->addCondition('rooms_count=3');
		$criteria3->limit = 2;

		$mainRooms[] = Catalog::model()->findAll($criteria3);


		//get main blocks
		$criteria_main = new CDbCriteria();
		//$criteria_action->addCondition('active=1');
		$criteria_main->order = 'sort';
		$criteria_main->limit = 4;

		$main_blocks = MainBlock::model()->findAll($criteria_main);

		/*$city_criteria = new CDbCriteria();
		$city_criteria->select
		$city_criteria->addCondition('active=1');
		$city_criteria->order = 'sort';
		$city_criteria->limit = 12;*/

		$this->city_block_rooms = Yii::app()->db->createCommand()
		    ->select('rooms_count, price_24')
		    ->from('catalog')
		    ->where('active=1 AND price_24 > 0')
		    ->limit(10)
		    ->queryAll();

		//$this->city_block_rooms = Catalog::model()->findAll($city_criteria);

		//count rooms
		//$this->count = Catalog::model()->count('active=1');
		$this->render('index', array(
			'mainRooms' => $mainRooms,
			'main_blocks' => $main_blocks,
			'benefits' => Benefit::model()->findAll(),
		));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->breadcrumbs=array(
  			'Контакты'
		);
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout = '//layouts/simple';

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}