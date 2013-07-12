<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'action-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->checkBoxRow($model, 'active',  array(1 => '')); ?>

	<?php echo $form->textAreaRow($model,'short_desc',array('class'=>'span5','maxlength'=>150)); ?>

	<?php echo $form->textAreaRow($model,'long_desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

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

	<?php echo $form->textFieldRow($model,'sort',array('class'=>'span5')); ?>

	<?php echo CHtml::label('Привязать квартиры', 'catalog'); ?>
	<?php $this->widget('admin_ext.select2.ESelect2', array(
		'name' => 'catalog',
		'data' =>CHtml::listData(Catalog::model()->no_action()->findAll(), 'id', 'address'),
		'htmlOptions' => array('id' => 'select','multiple'=>'multiple', 'style'=>'width: 40%;'),
		//'options' => array('multiple'=>'multiple',)
	));
	?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

	<div class="addCatItems" style="display: none;"></div>
	<div class="removeCatItems" style="display: none;"></div>

<?php $this->endWidget(); ?>

<?php //Yii::app()->clientScript->registerScriptFile($this->module->getAssetsUrl() . '/js/action.js', CClientScript::POS_END);?>
<?php Yii::app()->clientScript->registerScript('', '
	$("#select")
		.on("removed", function(e) {
			$(".addCatItems .id" + e.val).remove(); 
			$(".removeCatItems").append($("<input />").attr({name: "removeCatItems[]"}).addClass("id"+e.val).val(e.val)); 
		})
		.on("selected", function(e) {
			$(".removeCatItems .id" + e.val).remove();
			$(".addCatItems").append($("<input />").attr({name: "addCatItems[]"}).addClass("id"+e.val).val(e.val)); 
		})
	;
', CClientScript::POS_END);?>