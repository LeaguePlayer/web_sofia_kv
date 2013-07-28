<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'page-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->checkBoxRow($model, 'active',  array(1 => '')); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5 title','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'alias',array('class'=>'span5 alias','maxlength'=>255)); ?>

	<?php echo CHtml::activelabel($model,'content'); ?>
	<?php $this->widget('admin_ext.redactorjs.Redactor', array( 'model' => $model, 'attribute' => 'content'
	)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
<?php 
	Yii::app()->clientScript->registerScript('page', '
		$(".title").keyup(function(){
			var title = $(this).val();
			$.ajax({
				url: "'.$this->createUrl('/admin/page/translit').'",
				type: "GET",
				data: {str: title},
				success: function(data){
					$(".alias").val(data);
				}
			});
		});
	', CClientScript::POS_READY);
?>