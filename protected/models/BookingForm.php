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
			array('phone, email,rooms_count', 'required'),
			array('human_count, rooms_count, days, price', 'numerical'),
			array('fio, phone, email', 'length', 'max'=>255),
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
}