<?php
$this->breadcrumbs=array(
	'Квартиры',
);

$this->menu=array(
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Управление','url'=>array('admin')),
);
?>

<h1>Квартиры</h1>

<div class="span9">
	<?php $this->widget('bootstrap.widgets.TbListView',array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		'itemsCssClass' => 'thumbnails',
		'htmlOptions'=>array(		
		)
	)); ?>
</div>
