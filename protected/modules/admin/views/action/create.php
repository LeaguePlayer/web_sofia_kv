<?php
$this->breadcrumbs=array(
	'Actions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Action','url'=>array('index')),
	array('label'=>'Manage Action','url'=>array('admin')),
);
?>

<h1>Создать акцию</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>