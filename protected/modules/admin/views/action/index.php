<?php
$this->breadcrumbs=array(
	'Акции',
);

$this->menu=array(
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Управление','url'=>array('admin')),
);
?>

<h1>Акции</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
