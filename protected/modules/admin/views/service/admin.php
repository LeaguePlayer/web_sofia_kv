<?php
$this->breadcrumbs=array(
	'Отдых'=>array('admin'),
	'Управление',
);

$this->menu=array(
	//array('label'=>'Список','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('service-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление</h1>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'service-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'category',
		'link',
		'link_text',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
