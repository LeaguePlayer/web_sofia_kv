<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'active',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'short_desc',array('class'=>'span5','maxlength'=>150)); ?>

	<?php echo $form->textAreaRow($model,'long_desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'date_create',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'date_finish',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'gallery_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'sort',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
