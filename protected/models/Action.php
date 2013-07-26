<?php

/**
 * This is the model class for table "action".
 *
 * The followings are the available columns in table 'action':
 * @property integer $id
 * @property string $name
 * @property integer $active
 * @property string $short_desc
 * @property string $long_desc
 * @property string $date_create
 * @property string $date_finish
 * @property integer $gallery_id
 * @property integer $sort
 */
class Action extends CActiveRecord
{
	public function init()
	{
	   //$this->attachBehavior();
	   parent::init();
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'action';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('active, gallery_id, sort, new_price', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('short_desc', 'length', 'max'=>150),
			array('long_desc, date_create, date_finish', 'safe'),
			array('date_create, date_finish', 'date', 'format' => 'yyyy-MM-dd'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, active, short_desc, long_desc, date_create, date_finish, gallery_id, sort, new_price', 'safe', 'on'=>'search'),
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
			'action_rooms' => array(self::MANY_MANY, 'Catalog', 'catalog_actions(action_id, catalog_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Заголовок',
			'active' => 'Активна',
			'short_desc' => 'Краткое описание',
			'long_desc' => 'Полное описание',
			'date_create' => 'Дата создания',
			'date_finish' => 'Дата окончания',
			'gallery_id' => 'Gallery',
			'sort' => 'Вес',
			'new_price' => 'Новая цена для квартир'
		);
	}

	public function behaviors()
	{
	    return array(
	        'galleryBehavior' => array(
	            'class' => 'admin_ext.imagesgallery.GalleryBehavior',
	            'idAttribute' => 'gallery_id',
	            'versions' => array(
	                'big' => array(
	                    'adaptiveResize' => array(712, 430),
	                ),
	                'v1' => array(
	                    'adaptiveResize' => array(240, 133),
	                ),
	                'v2' => array(
	                    'adaptiveResize' => array(235, 290),
	                )
	            ),
	            'name' => true,
	            'description' => true,
	        ),
	        'sortableModel' => array(
		      'class' => 'SortableCActiveRecordBehavior'
		   )
	    );
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:@
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('short_desc',$this->short_desc,true);
		$criteria->compare('long_desc',$this->long_desc,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('date_finish',$this->date_finish,true);
		$criteria->compare('gallery_id',$this->gallery_id);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('new_price',$this->new_price);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
		        'defaultOrder'=>'sort ASC',
		    )
		));
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

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Action the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	protected function beforeValidate(){

		$this->date_create = date('Y-m-d');
		if(empty($this->date_finish)) $this->date_finish = "";
		else{
			$this->date_finish = MyHelper::getFormatedDate('Y-m-d', $this->date_finish);
/*			$date = date_create_from_format('d.m.Y', $this->date_finish);
			$this->date_finish = date_format($date, 'Y-m-d');*/
/*			print_r($date);
			print_r($this->date_finish);
			die();*/
		}

		return parent::beforeValidate();
	}

	protected function beforeSave(){
		//only one action active
		if($this->active == 1){ //if publication
			self::model()->updateAll(array('active' => 0));
			$this->active = 1;
		}
			

		return parent::beforeSave();
	}

	protected function afterSave(){

		//update main_block action
		if($this->active == 1){ //if publication
			MainBlock::model()->updateAll(array('model_id' => $this->id), 'model="Action"');
		}

		return parent::afterSave();
	}
}
