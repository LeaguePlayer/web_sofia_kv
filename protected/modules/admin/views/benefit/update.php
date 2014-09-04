<?php
$this->breadcrumbs=array(
	'Преимущества'=>array('index'),
	$model->title
);

$this->menu=array(
	array('label'=>'Преимущества','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
);
?>

<h1>Редактирование</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>