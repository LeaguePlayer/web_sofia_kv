<?php
$this->breadcrumbs=array(
	'Страницы'=>array('admin'),
	'Создать',
);

$this->menu=array(
	//array('label'=>'List Page','url'=>array('index')),
	array('label'=>'Управление','url'=>array('admin')),
);
?>

<h1>Создать</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>