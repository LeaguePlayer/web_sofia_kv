<?php
$this->breadcrumbs=array(
	'Промоблок на главной',
);

$empty = array('0' => 'Не выбрано');

$criteria = new CDbCriteria;
$criteria->addCondition('active=1');

//default data
$data = $empty + CHtml::listData(Catalog::model()->findAll($criteria), 'id', 'address');
$counter = 0;
?>

<h1>Промоблок на главной</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'catalog-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
	)
)); ?>
<div class="row-fluid">

	<?foreach($blocks as $i => $block):?>
	<span class="span3 block">
		<span class="handler">::</span>
		<?php echo CHtml::activeHiddenField($block, "[$counter]id");?>
		<?php echo CHtml::activeHiddenField($block, "[$counter]sort", array('class' => 'input_sort'));?>
		<?php
			$items = array();
			switch ($block->model) {
				case 'Catalog':
					$items = CHtml::listData(call_user_func(array($block->model, 'model'))->findAll($criteria), 'id', 'address');
					break;
				
				case 'Action':
					$items = CHtml::listData(call_user_func(array($block->model, 'model'))->findAll($criteria), 'id', 'name');
					break;

				case 'Page':
					$items = CHtml::listData(call_user_func(array($block->model, 'model'))->findAll($criteria), 'id', 'title');
					break;
			}
		?>
		<div style="text-align: center; padding: 5px;">
			<?=CHtml::image($block->getPreview('admin'), '', array('style'=>'width: 50%'));?>
		</div>
		<?php echo $form->dropDownListRow($block, "[$counter]model", MainBlock::getAllowModels(), array('class' => 'model_select', 'data-index' => $counter)); ?><br>
		<?php $this->widget('admin_ext.select2.ESelect2', array(
			'model' => $block,
			'attribute' => "[$counter]model_id",
			'data' => $empty + $items,
			'htmlOptions' => array('id' => 'select'.$counter, 'style'=>'width: 100%;', 'class'=>'select_item'),
		)); ?>
		<?php echo $form->error($block,'[$counter]model_id'); ?>
		<?php echo $form->fileFieldRow($block, "[$counter]preview"); ?>

		<?php $this->widget('bootstrap.widgets.TbButton', array(
		    'label'=>'Удалить',
		    'type'=>'danger',
		    'size'=>'small',
		    'buttonType' => 'link',
		    'url' => $this->createUrl('mainBlock/delete', array('id' => $block->id))
		)); ?>
	</span>
		<?php $counter++; ?>
	<?endforeach;?>

	<?foreach($models as $i => $model):?>
	<span class="span3 block">
		<span class="handler">::</span>
		<?php echo CHtml::activeHiddenField($model, "[$counter]sort", array('class' => 'input_sort'));?>

		<?php echo $form->dropDownListRow($model, "[$counter]model", MainBlock::getAllowModels(), array('class' => 'model_select', 'data-index' => $counter)); ?><br>
		<?php $this->widget('admin_ext.select2.ESelect2', array(
			'model' => $model,
			'attribute' => "[$counter]model_id",
			'data' => $data,
			'htmlOptions' => array('id' => 'select'.$counter, 'style'=>'width: 100%;', 'class'=>'select_item'),
		)); ?>
		<?php echo $form->error($model,'[$counter]model_id'); ?>
		<?php echo $form->fileFieldRow($model, "[$counter]preview"); ?>
	</span>
		<?php $counter++; ?>
	<?endforeach;?>

</div>
<div class="row-fluid">
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Сохранить',
		)); ?>
	</div>
</div>

<?php $this->endWidget(); ?>
<? Yii::app()->clientScript->registerCoreScript('jquery.ui');?>
<?php Yii::app()->clientScript->registerScriptFile($this->module->getAssetsUrl() . '/js/mainblock.js', CClientScript::POS_END);?>
