
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'action-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->checkBoxRow($model, 'active',  array(1 => '')); ?>

	<?php echo $form->textAreaRow($model,'short_desc',array('class'=>'span5','maxlength'=>150)); ?>

	<?php echo CHtml::activelabel($model,'long_desc'); ?>
	<?php $this->widget('admin_ext.ckeditor.CkeditorWidget', array( 'model' => $model, 'attribute' => 'long_desc', 'htmlOptions' => array('style'=>'height: 220px;')
	)); ?>

	<?php //echo $form->textAreaRow($model,'long_desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo CHtml::activeHiddenField($model,'date_create'); ?>

	<?php echo CHtml::activelabel($model,'date_finish'); ?>
	<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
			'model'=>$model,
			'attribute'=>'date_finish',
			'language' => 'ru',
		    // additional javascript options for the date picker plugin
		    'options'=>array(
		        'showAnim'=>'fold',
		        'dateFormat'=>'dd.mm.yy',
		        'minDate'=>0
		    ),
		    'htmlOptions'=>array(
		        'class'=>'span5'
		    ),
		));
	?>
	<?php echo CHtml::error($model,'date_finish'); ?>

	<?php echo $form->textFieldRow($model,'new_price',array('class'=>'span5')); ?>

	<?php echo CHtml::label('Привязать квартиры', 'catalog'); ?>
	<?php 
	$this->widget('admin_ext.select2.ESelect2', array(
		'name' => 'catalog',
		'data' =>CHtml::listData(Catalog::model()->findAll(), 'id', 'address'),
		'htmlOptions' => array('id' => 'select', 'multiple'=> true, 'style'=>'width: 40%;'),
		'events' =>array(
			'removed' => 'js:function(e) { $(".addCatItems .id" + e.val).remove(); $(".removeCatItems").append($("<input />").attr({name: "removeCatItems[]"}).addClass("id"+e.val).val(e.val)); }',
			'selected' => 'js:function(e) { $(".removeCatItems .id" + e.val).remove(); $(".addCatItems").append($("<input />").attr({name: "addCatItems[]"}).addClass("id"+e.val).val(e.val)); }'
		)/*,
		'options' => array('initSelection'=>'js:function(){
			console.log("fuck");
		}',)*/
	));
	?>
	<div class="addCatItems" style="display: none;"></div>
	<div class="removeCatItems" style="display: none;"></div>

	<?if($model->asa('seo')){?><br><br>
	<fieldset>
		<legend>Для SEO специалиста:</legend>
	    <?php echo $form->textFieldRow($model,'meta_title'); ?>
	    <?php echo $form->textFieldRow($model,'meta_keys'); ?>
	    <?php echo $form->textAreaRow($model,'meta_desc'); ?>
	    <?php echo CHtml::activelabel($model, 'meta_html');?>
	    <?php $this->widget('admin_ext.ckeditor.CkeditorWidget', array( 'model' => $model, 'attribute' => 'meta_html')); ?>
	</fieldset>
	<?}?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<?php $this->renderPartial('_modal_window');?>

<?php Yii::app()->clientScript->registerScript('', '
	var preload_data = '.$this->getRoomsAction($model->id).';
	$("#select").select2("data", preload_data);
', CClientScript::POS_READY);?>