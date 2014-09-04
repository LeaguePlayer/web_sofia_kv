<?php
$this->breadcrumbs=array(
	'Benefits'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Benefit','url'=>array('index')),
	array('label'=>'Create Benefit','url'=>array('create')),
	array('label'=>'Update Benefit','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Benefit','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Benefit','url'=>array('admin')),
);
?>

<h1>View Benefit #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'icon',
		'text',
	),
)); ?>
