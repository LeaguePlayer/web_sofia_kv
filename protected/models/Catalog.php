<?php

/**
 * This is the model class for table "catalog".
 *
 * The followings are the available columns in table 'catalog':
 * @property integer $id
 * @property string $address
 * @property integer $number
 * @property string $desc
 * @property string $features
 * @property integer $price_24
 * @property integer $price_night
 * @property integer $price_hour
 * @property integer $active
 * @property integer $area
 */
class Catalog extends CActiveRecord
{
	public static $classesFeatures = array(
		1 => 'wifi',
		2 => 'tele',
		3 => 'wash',
		4 => 'iron'
	);

	public static $allowFeatures = array(
		1 => 'В квартире есть Wi-Fi',
		2 => 'В квартире есть Кабельное TV',
		3 => 'В квартире есть Стиральная машинка',
		4 => 'В квартире есть Утюг'
	);

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'catalog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('address, number', 'required'),
			array('number, price_24, price_night, price_hour, active, area, gallery_id, human_count, action_id', 'numerical', 'integerOnly'=>true),
			array('address, features, rooms_count', 'length', 'max'=>255),
			array('desc', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, address, number, desc, features, price_24, price_night, price_hour, active, area, rooms_count, human_count, action_id', 'safe', 'on'=>'search'),
		);
	}

	public function behaviors()
	{
	    return array(
	        'galleryBehavior' => array(
	            'class' => 'admin_ext.imagesgallery.GalleryBehavior',
	            'idAttribute' => 'gallery_id',
	            'versions' => array(
	                'v1' => array(
	                    'resize' => array(280, 280),
	                ),
	                'v2' => array(
	                    'resize' => array(210, 280),
	                ),
	                'medium' => array(
	                    'resize' => array(1000, null),
	                )
	            ),
	            'name' => true,
	            'description' => true,
	        )
	    );
	}

	public function scopes()
    {
        return array(
            'no_action'=>array(
                'condition'=>'action_id=0',
                'order'=>'address'
            ),
        );
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'cat_area' => array(self::BELONGS_TO, 'Area', 'area'),
			'action' => array(self::BELONGS_TO, 'Action', 'action_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'address' => 'Адрес',
			'number' => 'Номер квартиры',
			'desc' => 'Описание',
			'features' => 'Удобства',
			'price_24' => 'Цена за сутки',
			'price_night' => 'Цена за ночь',
			'price_hour' => 'Цена за час',
			'active' => 'Активна',
			'area' => 'Район',
			'rooms_count' => 'Количество комнат',
			'human_count' => 'Количество спальных мест',
			'action_id' => 'Акция'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('number',$this->number);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('features',$this->features,true);
		$criteria->compare('price_24',$this->price_24);
		$criteria->compare('price_night',$this->price_night);
		$criteria->compare('price_hour',$this->price_hour);
		$criteria->compare('active',$this->active);
		$criteria->compare('area',$this->area);
		$criteria->compare('rooms_count',$this->rooms_count);
		$criteria->compare('human_count',$this->human_count);
		$criteria->compare('action_id',$this->action_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Catalog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getFeatures(){
		return array(
			1 => 'Wi-Fi',
			2 => 'TV',
			3 => 'Стиральная машина',
			4 => 'Утюг'
		);
	}

	public static function getRoomsCount(){
		return array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5');
	}

	public static function getHumanCount(){
		return array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8');
	}

	protected function beforeValidate()
	{
	    if(!empty($this->features))
	    	$this->features = implode(',', $this->features);
	    else
	    	$this->features = "";

	    return parent::beforeValidate();
	}
}
