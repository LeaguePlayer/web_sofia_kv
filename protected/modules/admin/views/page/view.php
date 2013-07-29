<?php
$this->breadcrumbs=array(
	'Страницы'=>array('admin'),
	$model->title,
);

$this->menu=array(
	//array('label'=>'List Page','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Обновить','url'=>array('update','id'=>$model->id)),
	array('label'=>'Удалить','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление','url'=>array('admin')),
);
?>

<h1>Страница - <?php echo $model->title; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'title',
		'alias',
		'content',
		'active',
	),
)); ?>
