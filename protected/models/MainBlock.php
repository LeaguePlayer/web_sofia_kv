<?php

/**
 * This is the model class for table "main_block".
 *
 * The followings are the available columns in table 'main_block':
 * @property integer $id
 * @property string $model
 * @property integer $model_id
 */
class MainBlock extends CActiveRecord
{
	const LIMIT = 4;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'main_block';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('model_id', 'numerical', 'min' => 1, 'integerOnly'=>true),
			array('sort', 'numerical', 'integerOnly'=>true),
			array('model', 'length', 'max'=>100),
			array('preview', 'file', 'maxFiles'=>1, 'allowEmpty' => true, 'maxSize' => (1024 * 1024) * 4, 'types' => 'jpeg, jpg, png, gif'),
			//array('preview', 'file', 'maxFiles'=>1, 'maxSize' => (1024 * 1024) * 4, 'types' => 'jpeg, jpg, png, gif'),
			//array('preview', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, model, model_id', 'safe', 'on'=>'search'),
		);
	}
/*
	public function behaviors()
	{
	    return array(
	        'sortableModel' => array(
		      'class' => 'SortableCActiveRecordBehavior'
		   	)
	    );
	}
*/
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'model' => 'Источник',
			'model_id' => 'Элемент',
			'preview' => 'Изображение'
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
		$criteria->compare('model',$this->model,true);
		$criteria->compare('model_id',$this->model_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MainBlock the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	protected function beforeDelete()
	{
	    $this->removeImages();
	    return parent::beforeDelete();
	}

	public static function getAllowModels(){
		return array(
			'Catalog' => 'Квартира',
			'Action' => 'Акция',
			'Page' => 'Страница',
			//'Catalog' => 'Квартиры',
		);
	}

	public static function getUploadPath(){
		$upload_dir = Yii::getPathOfAlias('webroot.upload');

		if(!file_exists($upload_dir)){
			mkdir($upload_dir);
			chmod($upload_dir, 755);
		}
		return $upload_dir;
	}

	public function getPreview($name = ''){
		return DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.$name.$this->preview;
	}

	public function removeImages(){
		@unlink(self::getUploadPath().DIRECTORY_SEPARATOR.$this->preview);
		@unlink(self::getUploadPath().DIRECTORY_SEPARATOR.'big'.$this->preview);
		@unlink(self::getUploadPath().DIRECTORY_SEPARATOR.'small'.$this->preview);
		@unlink(self::getUploadPath().DIRECTORY_SEPARATOR.'admin'.$this->preview);
	}
}
