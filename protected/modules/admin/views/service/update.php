<?php
$this->breadcrumbs=array(
	'Отдых'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Обновить',
);

$this->menu=array(
	//array('label'=>'Список','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Посмотреть','url'=>array('view','id'=>$model->id)),
	array('label'=>'Управление','url'=>array('admin')),
);
?>

<h1>Обновить</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>