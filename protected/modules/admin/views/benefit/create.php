<?php
$this->breadcrumbs=array(
	'Преимущества'=>array('index'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Преимущества','url'=>array('index')),
);
?>

<h1>Создание преимущества</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>