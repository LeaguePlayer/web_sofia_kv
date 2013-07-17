<?php
$this->breadcrumbs=array(
	'Catalogs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Catalog','url'=>array('index')),
	array('label'=>'Create Catalog','url'=>array('create')),
	array('label'=>'Update Catalog','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Catalog','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Catalog','url'=>array('admin')),
);
?>

<h1><?php echo CHtml::encode($model->address).' - '.CHtml::encode($model->number); ?></h1>

<?php
	$features = array_intersect_key(Catalog::getFeatures(), array_flip(explode(',', $model->features)));
?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name' => 'active',
			'type' => 'text',
			'value' => $model->active == 1 ?'да' : 'нет'
		),
		'address',
		'number',
		'rooms_count',
		'human_count',
		'desc',
		array(
			'name' => 'features',
			'type' => 'text',
			'value' => implode(", ", $features)
		),
		array(
			'name' => 'price_24',
			'type' => 'text',
			'value' => CHtml::encode($model->price_24)." р."
		),
		array(
			'name' => 'price_night',
			'type' => 'text',
			'value' => CHtml::encode($model->price_night)." р."
		),
		array(
			'name' => 'price_hour',
			'type' => 'text',
			'value' => CHtml::encode($model->price_hour)." р."
		),
		//'preview',
		array(
			'label' => 'Районы',
			'type' => 'text',
			'value' => implode(', ', CHtml::listdata($model->cat_areas, 'id', 'name'))
		),
	),
)); ?>

<?php echo CHtml::label('Фотографии квартиры', 'gallery');?>
<?php
$this->widget('admin_ext.imagesgallery.GalleryManager', array(
	'gallery' => $model->galleryBehavior->getGallery(),
    'controllerRoute' => '/admin/gallery', //route to gallery controller
));
?>