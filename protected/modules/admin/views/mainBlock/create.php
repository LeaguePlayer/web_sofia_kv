<?php
/* @var $this MainBlockController */
/* @var $model MainBlock */

$this->breadcrumbs=array(
	'Main Blocks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MainBlock', 'url'=>array('index')),
	array('label'=>'Manage MainBlock', 'url'=>array('admin')),
);
?>

<h1>Create MainBlock</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>