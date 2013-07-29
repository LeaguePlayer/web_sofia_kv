<?php
$this->breadcrumbs=array(
	'Catalogs'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Все квартиры','url'=>array('admin')),
);
?>

<h1>Добавить квартиру</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'areas'=>$areas)); ?>