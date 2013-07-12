<?php
$this->breadcrumbs=array(
	'Catalogs',
);

$this->menu=array(
	array('label'=>'Create Catalog','url'=>array('create')),
	array('label'=>'Manage Catalog','url'=>array('admin')),
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
