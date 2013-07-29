<?php
$this->breadcrumbs=array(
	'Районы',
);
/*
$this->menu=array(
	array('label'=>'Create Area','url'=>array('create')),
	array('label'=>'Manage Area','url'=>array('admin')),
);*/
?>

<h1>Районы</h1>

<span class="span10">
<!-- 	<div class="progress progress-success progress-striped active">
		<div class="bar" style="width: 100%"></div>
	</div> -->
	<div class="alert alert-success" style="display: none;">
	  	<button type="button" class="close" data-dismiss="alert">&times;</button>
	  	<strong>Изменения сохранены.</strong>
	</div>
	<form id="areas-form" type="post" action="">
		<table class="table table-striped">
			<thead>
				<tr>
					<th><?=CHtml::activeLabel($model, 'name')?></th>
					<th></th>
				</tr>
			</thead>
			<tbody data-bind="foreach: areas">
				<tr>
					<td>
						<?=CHtml::activeHiddenField($model, '[]id', array('data-bind'=>'value: id'))?>
						<?=CHtml::activeTextField($model, '[]name', array('data-bind'=>'value: name'))?></td>
					<td><?=CHtml::button('Удалить', array('data-bind'=>'click: $parent.remove', 'class' => 'btn btn-danger'))?></td>
				</tr>
			</tbody>
		</table>
	</form>
</span>	
<div class="span12">
	<div class="btn-toolbar">
		  <div class="btn-group">
			    <?=CHtml::link('Сохранить', '#', array('data-bind'=>'click: save, visible: areas().length > 0', 'class' => 'btn btn-success', 'title' => 'Добавить', 'id'=> 'save'))?>
			    <?=CHtml::link('<i class="icon-plus"></i>', '#', array('data-bind'=>'click: addArea', 'class' => 'btn', 'title' => 'Добавить'))?>
		  </div>
	</div>
	
</div>

<?php Yii::app()->clientScript->registerScriptFile($this->module->getAssetsUrl() . '/js/area.js', CClientScript::POS_END);?>
