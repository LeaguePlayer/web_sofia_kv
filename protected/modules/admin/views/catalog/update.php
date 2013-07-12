<?php
$this->breadcrumbs=array(
	'Квартиры'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Обновление',
);

$this->menu=array(
	array('label'=>'List Catalog','url'=>array('index')),
	array('label'=>'Create Catalog','url'=>array('create')),
	array('label'=>'View Catalog','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Catalog','url'=>array('admin')),
);
?>

<h1>Обновление квартиры <?php echo $model->address.' - '.$model->number; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model, 'areas'=>$areas	)); ?>