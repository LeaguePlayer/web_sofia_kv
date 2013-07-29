<?php
$this->breadcrumbs=array(
	'Отдых'=>array('admin'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'Список','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Обновить','url'=>array('update','id'=>$model->id)),
	array('label'=>'Удалить','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление','url'=>array('admin')),
);
?>

<h1>Ссылка <?php echo $model->link_text; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'category',
		'link',
		'link_text',
	),
)); ?>
