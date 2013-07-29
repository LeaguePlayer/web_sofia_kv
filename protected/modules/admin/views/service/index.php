<?php
$this->breadcrumbs=array(
	'Отдых',
);

$this->menu=array(
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Управление','url'=>array('admin')),
);
?>

<h1>Ссылки</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
