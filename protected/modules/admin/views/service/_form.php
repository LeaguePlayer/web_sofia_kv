<?php
$category = Service::model()->findAll(array('select' => 'category'));
$cats = array();
foreach ($category as $value) {
	$cats[] = $value['category'];
	//print_r($value['category']);
}
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'service-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'category',array('class'=>'span5 category','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'link',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'link_text',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<?php Yii::app()->clientScript->registerCoreScript('jquery.ui');?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');?>
<?php Yii::app()->clientScript->registerScript('links', '
	var available = '.CJavaScript::encode($cats).';
	$(".category").autocomplete({
      source: available
    });

', CClientScript::POS_READY);?>