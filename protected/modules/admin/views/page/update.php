<?php
$this->breadcrumbs=array(
	'Страницы'=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	'Обновить',
);

$this->menu=array(
	//array('label'=>'List Page','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Просмотр','url'=>array('view','id'=>$model->id)),
	array('label'=>'Управление','url'=>array('admin')),
);
?>

<h1>Обновить <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>