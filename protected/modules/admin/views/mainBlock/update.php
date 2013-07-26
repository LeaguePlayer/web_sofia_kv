<?php
/* @var $this MainBlockController */
/* @var $model MainBlock */

$this->breadcrumbs=array(
	'Main Blocks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MainBlock', 'url'=>array('index')),
	array('label'=>'Create MainBlock', 'url'=>array('create')),
	array('label'=>'View MainBlock', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MainBlock', 'url'=>array('admin')),
);
?>

<h1>Update MainBlock <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>