<?php

class BookingForm extends CFormModel{

	public $rooms_count;
	public $human_count;
	public $price;
	public $days;
	public $fio;
	public $phone;
	public $email;
	public $message;

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('phone, email, rooms_count, price', 'required'),
			array('human_count, days, price', 'numerical'),
			array('fio, phone, email, rooms_count', 'length', 'max'=>255),
			array('email', 'email'),
			array('message', 'safe'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'rooms_count'=>'Количество комнат',
			'human_count'=>'Количество спальных мест',
			'price'=>'Цена',
			'days'=>'Количество дней',
		);
	}

	protected function beforeValidate()
	{
		$rooms_count = array();
	   if(isset($_POST['BookingForm'])){
    		foreach ($_POST['BookingForm']['rooms_count'] as $key => $value) {
				if($value != 0) $rooms_count[] = $key;
			}
			$this->rooms_count = implode(',', $rooms_count);
    	}

	    return parent::beforeValidate();
	}

	protected function afterValidate()
	{
		$this->rooms_count = $_POST['BookingForm']['rooms_count'];
	    return parent::afterValidate();
	}
}