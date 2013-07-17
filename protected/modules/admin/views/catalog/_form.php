<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'catalog-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->checkBoxRow($model, 'active',  array(1 => '')); ?>

	<?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'number',array('class'=>'span1')); ?>

	<?php echo $form->dropDownListRow($model, 'rooms_count', Catalog::getRoomsCount(), array('class'=>'span1')); ?>

	<?php echo $form->dropDownListRow($model, 'human_count', Catalog::getHumanCount(), array('class'=>'span1')); ?>

	<?php echo CHtml::activelabel($model,'desc'); ?>
	<?php $this->widget('admin_ext.redactorjs.Redactor', array( 'model' => $model, 'attribute' => 'desc', 
		'htmlOptions' => array('style'=>'height: 220px;')
	)); ?>
	
	<?php //echo $form->textAreaRow($model,'desc',array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>

	<?php echo $form->checkBoxListInlineRow($model, 'features', Catalog::getFeatures()); ?>

	<?php echo $form->textFieldRow($model,'price_24',array('class'=>'input-small')); ?>

	<?php echo $form->textFieldRow($model,'price_night',array('class'=>'input-small')); ?>

	<?php echo $form->textFieldRow($model,'price_hour',array('class'=>'input-small')); ?>

	<?php echo CHtml::label('Районы квартиры', 'areas'); ?>
	<?php $this->widget('admin_ext.select2.ESelect2', array(
		'name' => 'areas',
		'data' =>CHtml::listData(Area::model()->findAll(), 'id', 'name'),
		'htmlOptions' => array('id' => 'select', 'multiple'=> true, 'style'=>'min-width: 200px;'),
		'events' =>array(
			'removed' => 'js:function(e) { $(".addItems .id" + e.val).remove(); $(".removeItems").append($("<input />").attr({name: "removeItems[]"}).addClass("id"+e.val).val(e.val)); }',
			'selected' => 'js:function(e) { $(".removeItems .id" + e.val).remove(); $(".addItems").append($("<input />").attr({name: "addItems[]"}).addClass("id"+e.val).val(e.val)); }'
		)/*,
		'options' => array('initSelection'=>'js:function(){
			console.log("fuck");
		}',)*/
	));
	?>
	<div class="addItems" style="display: none;"></div>
	<div class="removeItems" style="display: none;"></div>

	<?php //echo $form->dropDownListRow($model, 'area', CHtml::listData($areas, 'id', 'name')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
<?php Yii::app()->clientScript->registerScript('', '
	var preload_data = '.$this->getItemAreas($model->id).';
	$("#select").select2("data", preload_data);
', CClientScript::POS_READY);?>
