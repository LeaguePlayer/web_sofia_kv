<?php
$this->breadcrumbs=array(
	'Акции'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Обновление',
);

$this->menu=array(
	//array('label'=>'Список','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Просмотреть','url'=>array('view','id'=>$model->id)),
	array('label'=>'Управление','url'=>array('admin')),
);
?>

<h1>Обновить акцию - <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>