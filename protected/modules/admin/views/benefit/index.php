<?php
$this->breadcrumbs=array(
	'Преимущества',
);

$this->menu=array(
	array('label'=>'Создать','url'=>array('create')),
);
?>

<h1>Преимущества</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'benefit-grid',
	'dataProvider'=>Benefit::model()->search(),
	'filter'=>Benefit::model(),
	'columns'=>array(
		'title',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

