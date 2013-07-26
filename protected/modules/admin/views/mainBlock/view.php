<?php
/* @var $this MainBlockController */
/* @var $model MainBlock */

$this->breadcrumbs=array(
	'Main Blocks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MainBlock', 'url'=>array('index')),
	array('label'=>'Create MainBlock', 'url'=>array('create')),
	array('label'=>'Update MainBlock', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MainBlock', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MainBlock', 'url'=>array('admin')),
);
?>

<h1>View MainBlock #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'model',
		'model_id',
	),
)); ?>
