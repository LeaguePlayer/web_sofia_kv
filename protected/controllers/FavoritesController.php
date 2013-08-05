<?php

class FavoritesController extends Controller{

	public function actionIndex(){
		$model = new Catalog;
		$criteria = CatalogController::getCriteriaForFilter($model);

		if($this->cookie_exists())
			$criteria->addInCondition('t.id', unserialize($this->getRoomsCookie()));
		else
			$criteria->addInCondition('t.id', array());

		$dataProvider=new CActiveDataProvider('Catalog', array('criteria' => $criteria));

		$areas = Area::model()->findAll(array('order' => 'name'));

		/*$this->render('view', array(
			'action' => $this->loadModel($id),
			'model' => $model,
			'areas' => $areas,
			'action_rooms' => $action_rooms
		));*/

		$this->render('/catalog/index', array(
			'data' => $dataProvider,
			'model' => $model,
			'areas' => $areas,
			'favor' => true
		));
	}

	//add room in cookie
	public function actionAddRoom($id){
		if($this->cookie_exists()){
			$rooms = unserialize($this->getRoomsCookie());
			if(!in_array($id, $rooms)){
				if(is_numeric($id) && $id > 0) $rooms[] = $id;
				$this->setRoomsCookie(serialize($rooms));
			}
		}else{
			$this->setRoomsCookie(serialize(array($id)));
		}
		Yii::app()->end();
	}

	//remove room from cookie
	public function actionRemoveRoom($id){
		if($this->cookie_exists()){
			$rooms = unserialize($this->getRoomsCookie());
			if(in_array($id, $rooms)){
				$key = array_search($id, $rooms);
				unset($rooms[$key]);
				$this->setRoomsCookie(serialize($rooms));
			}
		}
		Yii::app()->end();
	}

	private function getRoomsCookie(){
		return Yii::app()->request->cookies['rooms']->value;
	}

	private function setRoomsCookie($value){
		$cookie = new CHttpCookie('rooms', $value);
		$cookie->expire = time() + 2592000; // 30 days
		Yii::app()->request->cookies['rooms'] = $cookie;
	}

	private function cookie_exists(){
		return isset(Yii::app()->request->cookies['rooms']);
	}

	//check room in cookie
	public static function is_room_exists($id){
		if(isset(Yii::app()->request->cookies['rooms'])){
			$rooms = unserialize(Yii::app()->request->cookies['rooms']->value);
			if(in_array($id, $rooms))
				return true;
		}
		return false;
	}
}