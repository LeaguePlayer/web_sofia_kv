<?php
$this->breadcrumbs=array(
	'Акции'=>array('admin'),
	'Создать',
);

$this->menu=array(
	//array('label'=>'Список','url'=>array('index')),
	array('label'=>'Управление','url'=>array('admin')),
);
?>

<h1>Создать акцию</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>