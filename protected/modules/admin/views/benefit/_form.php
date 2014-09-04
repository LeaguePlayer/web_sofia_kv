<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'benefit-form',
	'enableAjaxValidation'=>false,
)); ?>

    <?php if(Yii::app()->user->hasFlash('success')):?>
        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
    <?php endif; ?>
	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->dropDownListRow($model, 'icon', Benefit::getIcons(), array('class'=>'span5', 'displaySize'=>1)); ?>

	<div style="overflow:hidden;">
			<?php echo CHtml::activelabel($model,'text'); ?>
		<div style="width: 40%">
			<?php $this->widget('admin_ext.ckeditor.CkeditorWidget', array( 'model' => $model, 'attribute' => 'text')); ?>
		</div>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
