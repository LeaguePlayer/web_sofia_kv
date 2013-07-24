<?php
$this->breadcrumbs=array(
	'Actions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Action','url'=>array('index')),
	array('label'=>'Create Action','url'=>array('create')),
);

/*Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('action-grid', {
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
 
        $('#action-grid table.items tbody').sortable({
            forcePlaceholderSize: true,
            forceHelperSize: true,
            items: 'tr',
            handle: '.sort',
            update : function () {
                var serial = $('#action-grid table.items tbody').sortable('serialize', {key: 'items[]', attribute: 'class'});
                console.log(serial);
                $.ajax({
                    'url': '" . $this->createUrl('/admin/action/sort') . "',
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

<h1>Управление акциями</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'action-grid',
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
			'name' => 'name',
			'type'=>'html',
			'value' => 'CHtml::link($data->name, array("view","id"=>$data->id))'
		),
		array(
			'name' => 'active',
			'value' => '$data->active == 1 ? "Да" : "Нет"'
		),
		'short_desc',
		//'long_desc',
		
		array(
			'name' => 'date_create',
			'value' => 'MyHelper::getFormatedDate("m.d.Y", $data->date_create)'
		),
		//'sort',
		/*
		'date_finish',
		'gallery_id',
		'sort',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
<? 
	Yii::app()->clientScript->registerScript('action-grid', $str_js, CClientScript::POS_READY);
	Yii::app()->clientScript->registerCoreScript('jquery.ui');
?>