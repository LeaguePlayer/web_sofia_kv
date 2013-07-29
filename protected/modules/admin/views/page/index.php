<?php
$this->breadcrumbs=array(
	'Страницы',
);

$this->menu=array(
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Управление','url'=>array('admin')),
);
?>

<h1>Страницы</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
