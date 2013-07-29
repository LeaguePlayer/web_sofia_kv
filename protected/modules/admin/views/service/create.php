<?php
$this->breadcrumbs=array(
	'Отдых'=>array('admin'),
	'Создать',
);

$this->menu=array(
	//array('label'=>'Список','url'=>array('index')),
	array('label'=>'Управление','url'=>array('admin')),
);
?>

<h1>Создать ссылку</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>