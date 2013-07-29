<?php
$this->breadcrumbs=array(
	'Акции'=>array('admin'),
	$model->name,
);

$this->menu=array(
	//array('label'=>'List Action','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Обновить','url'=>array('update','id'=>$model->id)),
	array('label'=>'Удалить','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление','url'=>array('admin')),
);
?>

<h1>Акция - <?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		array(
			'name' => 'active',
			'type' => 'text',
			'value' => $model->active == 1 ?'да' : 'нет'
		),
		'name',
		'short_desc',
		'long_desc',
		array(
			'name' => 'date_create',
			'type' => 'text',
			'value' => date("d.m.Y", strtotime($model->date_create))
		),
		array(
			'name' => 'date_finish',
			'type' => 'text',
			'value' => $model->date_finish != '0000-00-00' ? date("d.m.Y", strtotime($model->date_finish)) : 'Не задана'
		),
		'new_price',
	),
)); ?>

<?php
$this->widget('admin_ext.imagesgallery.GalleryManager', array(
	'gallery' => $model->galleryBehavior->getGallery(),
    'controllerRoute' => '/admin/gallery', //route to gallery controller
));
?>