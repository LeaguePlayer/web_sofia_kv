<?php
$this->breadcrumbs=array(
	'Страницы'=>array('admin'),
	'Управление',
);

$this->menu=array(
	//array('label'=>'List Page','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('page-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'page-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		array(
			'name' => 'title',
			'type'=>'html',
			'value' => 'CHtml::link($data->title, array("view","id"=>$data->id))'
		),
		'active',
		'alias',
		//'content',
		array(
			'header' => 'Ссылка',
			'type'=>'html',
			'value' => 'CHtml::link("/page/".$data->alias, "/page/".$data->alias, array("target"=>"_blank"))'
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
