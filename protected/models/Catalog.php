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
	public $preview = "";
	public $in_favorites = false;

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

	public function setPreview($val){
		$this->preview = $val;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('address, number, coords', 'required'),
			array('number, price_24, price_night, price_hour, active, gallery_id, human_count, sort', 'numerical', 'integerOnly'=>true),
			array('address, features, rooms_count', 'length', 'max'=>255),
			//array('tour_3d', 'file', 'allowEmpty'=>true, 'types' => 'swf'),
			array('coords', 'length', 'max'=>100),
			array('desc', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, address, number, desc, features, price_24, price_night, price_hour, active, rooms_count, human_count', 'safe', 'on'=>'search'),
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
	        ),
	        'sortableModel' => array(
		      'class' => 'SortableCActiveRecordBehavior'
		   	),
		   	'seo' => array('class' => 'SeoBehavior'),
		   	'tour' => array('class' => 'TourBehavior')
	    );
	}

	public function defaultScope()
	{
		//only with photos
	    return array(
	    	'select' => $this->getTableAlias(false,false).'.*',
	    	'distinct' => true,
	    	'join' => 'INNER JOIN gallery ON gallery_id = gallery.id INNER JOIN gallery_photo ON gallery.id = gallery_photo.gallery_id'
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
			'cat_areas' => array(self::MANY_MANY, 'Area', 'catalog_areas(catalog_id, area_id)'),
			'cat_actions' => array(self::MANY_MANY, 'Action', 'catalog_actions(catalog_id, action_id)',
				'condition' => 'cat_actions.active = 1  AND new_price != 0'
			),
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
			'rooms_count' => 'Количество комнат',
			'human_count' => 'Количество человек',
			'coords' => 'Координаты',
			'tour_3d' => '3d тур'
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
		$criteria->compare('rooms_count',$this->rooms_count);
		$criteria->compare('human_count',$this->human_count);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
		        'defaultOrder'=>'sort ASC',
		    )
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

	public function getPreviewImage($v = ''){
		$image = $this->gallery->main;

		if(!empty($image)){
			if($v == '')
				return $image->getPreview();
			else
				return $image->getUrl($v);
		}
	}

	//mdaaaa
	/*public function getNoActionItems(){
		//$sql = 'SELECT id, address FROM catalog WHERE id NOT IN(SELECT catalog_id FROM catalog_actions);';
		return Yii::app()->db->createCommand($sql)->queryAll();
	}*/

	public static function getRoomsCount(){
		return array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5');
	}

	public static function getHumanCount(){
		return array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10');
	}

	protected function beforeValidate()
	{
	    if(!empty($this->features))
	    	$this->features = implode(',', $this->features);
	    else
	    	$this->features = "";

	    return parent::beforeValidate();
	}

	public function getAttributes($names = true) {
        $attrs = parent::getAttributes($names);
        $attrs['preview'] = $this->getPreviewImage();
        $attrs['in_favorites'] = FavoritesController::is_room_exists($this->id);

        return $attrs;
    }


    protected function beforeFind() {
    	parent::beforeFind();
	   	
	   	if(Yii::app()->controller instanceof AdminController){
	   		$this->resetScope();
	   	}
		//if(false) 
		//echo get_called_class();
    
  	}

  	//send sms
  	public static function sendSMSLight($phone, $text, $sender)
    {
   		$login = "LeaguePlayer";
		$password = "qwelpo86";
		$host = "api.infosmska.ru";

		$fp = fsockopen($host, 80);
		fwrite($fp, "GET /interfaces/SendMessages.ashx" .
			"?login=" . rawurlencode($login) .
			"&pwd=" . rawurlencode($password) .
			"&phones=" . rawurlencode($phone) .
			"&message=" . rawurlencode($text) .
			"&sender=" . rawurlencode($sender) .
			" HTTP/1.1\r\nHost: $host\r\nConnection: Close\r\n\r\n");

		fwrite($fp, "Host: " . $host . "\r\n");
		fwrite($fp, "\n");

		$response = '';

		while(!feof($fp)) {
			$response .= fread($fp, 1);
		}

		fclose($fp);

		list($other, $responseBody) = explode("\r\n\r\n", $response, 2);
		list($other, $ids_str) = explode(":", $responseBody, 2);
		list($sms_id, $other) = explode(";", $ids_str, 2);

		return $sms_id;
    }

}
