<?php

class CallForm extends CFormModel{

	public $fio;
	public $phone;

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('phone', 'required'),
			array('fio, phone', 'length', 'max'=>255),
		);
	}

	public function attributeLabels()
	{
		return array(
			'fio' => 'Ваше имя',
			'phone' => 'Контактный номер',
		);
	}

}