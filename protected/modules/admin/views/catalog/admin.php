<?php
$this->breadcrumbs=array(
	'Квартиры'=>array('admin'),
	'Управление',
);

$this->menu=array(
	//array('label'=>'List Catalog','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
);

/*Yii::app()->clientScript->registerScript('search', "
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
");*/
?>

<?php
    $str_js = "
        var fixHelper = function(e, ui) {
            ui.children().each(function() {
                $(this).width($(this).width());
            });
            return ui;
        };
 
        $('#catalog-grid table.items tbody').sortable({
            forcePlaceholderSize: true,
            forceHelperSize: true,
            items: 'tr',
            handle: '.sort',
            update : function () {
                var serial = $('#catalog-grid table.items tbody').sortable('serialize', {key: 'items[]', attribute: 'class'});
                console.log(serial);
                $.ajax({
                    'url': '" . $this->createUrl('/admin/catalog/sort') . "',
                    'type': 'post',
                    'data': serial,
                    'success': function(data){
                    },
                    'error': function(request, status, error){
                        console.log('We are unable to set the sort order at this time.  Please try again in a few minutes.');
                    }
                });
            },
            helper: fixHelper
        }).disableSelection();
    ";

?>

<h1>Управление квартирами</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'catalog-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'rowCssClassExpression'=>'"items[]_{$data->id}"',
	'columns'=>array(
		array(
			'type' => 'text',
			'value' => '"::"',
			'htmlOptions' => array(
                'class' => 'sort'
            ),
		),
		array(
			//'name' => 'Обложка',
			'header' => 'Превью',
			'type'=>'html',
			'value' => 'CHtml::link(CHtml::image($data->getPreviewImage(),"",array("style"=>"width:100px;")), array("view","id"=>$data->id))'
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
		/*array(
			'name' => 'area',
			'value' => '$data->cat_area->name'
		),*/
		//'sort',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

<? 
	Yii::app()->clientScript->registerScript('catalog-grid', $str_js, CClientScript::POS_READY);
	Yii::app()->clientScript->registerCoreScript('jquery.ui');
?>

