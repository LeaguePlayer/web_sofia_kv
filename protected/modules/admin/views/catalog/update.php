<?php
$this->breadcrumbs=array(
	'Квартиры'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Обновление',
);

$this->menu=array(
	//array('label'=>'List Catalog','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Просмотреть','url'=>array('view','id'=>$model->id)),
	array('label'=>'Управление','url'=>array('admin')),
);
?>

<h1>Обновление квартиры <?php echo $model->address.' - '.$model->number; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model, 'areas'=>$areas	)); ?>