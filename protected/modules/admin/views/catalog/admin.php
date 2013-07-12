<?php
$this->breadcrumbs=array(
	'Квартиры'=>array('admin'),
	'Управление',
);

$this->menu=array(
	//array('label'=>'List Catalog','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('catalog-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление квартирами</h1>
<?php
/*<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>*/
?>
<?php /*echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); */?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'catalog-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			//'name' => 'Обложка',
			'header' => 'Превью',
			'type'=>'html',
			'value' => 'CHtml::link(CHtml::image($data->gallery->main->getPreview(), "", array("style"=>"height:75px;")),array("view","id"=>$data->id))'
		),
		array(
			'name' => 'address',
			'type'=>'html',
			'value' => 'CHtml::link($data->address, array("view","id"=>$data->id))'
		),
		'number',
		'rooms_count',
		'human_count',
		array(
			'name' => 'active',
			'value' => '$data->active == 1 ? "Да" : "Нет"'
		),
		//'desc',
		//'features',
		/*array(
			'header' => 'Цена',
			'value' => '$data->price_24." р. ,".$data->price_night." р. ,".$data->price_hour." р."'
		),*/
		'price_24',
		'price_night',
		'price_hour',
		array(
			'name' => 'area',
			'value' => '$data->cat_area->name'
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
