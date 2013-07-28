<?php
	if(!isset($ajax)){
		$model = new BookingForm;
		$model->human_count = 1;
		$model->days = 1;
	}
?>

<div class="order-block">
	<header>
		<h1>Нет времени подбирать квартиру самостоятельно?</h1>
	</header>
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'booking-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>
	<div class="left">
		<div class="text-title"><?=$model->getAttributeLabel('rooms_count')?></div>
		<div class="row checkbox-rooms">
			<?php echo $form->checkBox($model, 'rooms_count[1]', array('id'=>'check1'));?><label for="check1">1-комнатная</label>
			<?php echo $form->checkBox($model, 'rooms_count[2]', array('id'=>'check2'));?><label for="check2">2-комнатная</label>
			<?php echo $form->checkBox($model, 'rooms_count[3]', array('id'=>'check3'));?><label for="check3">3-комнатная</label>
		</div>
		<?php echo $form->labelEx($model, 'human_count', array('class' => 'text-title')); ?>
		<div class="row sleeper">
			<div id="order_sleeper-count" class="sleeper_count"></div>
			<?php echo $form->hiddenField($model, 'human_count', array('class' => 'human'));?>
			<label class="text-ot">от <b>1</b></label>
			<label class="text-do">от <b>8</b></label>
		</div>
		<div class="row price">
			<?php echo $form->labelEx($model, 'price', array('class' => 'text-title')); ?>
			<?php echo $form->textField($model, 'price', array('class'=>'input'));?>
			<span>рублей</span>
		</div>
		<div class="row days">
			<?php echo $form->labelEx($model, 'days', array('class' => 'text-title')); ?>
			<?php echo $form->numberField($model, 'days', array('class'=>'input', 'min'=>1));?>
		</div>
	</div>
	<div class="right">
		<div class="row">
			<?php echo $form->textField($model, 'fio', array('class'=>'input', 'placeholder'=>'ФИО'));?>
		</div>
		<div class="row">
			<?php
			$this->widget('CMaskedTextField', array(
				'model' => $model,
				'attribute' => 'phone',
				'mask' => '+7 (999) 999-99-99',
				'htmlOptions' => array('class'=>'input', 'placeholder'=>'Контактный номер телефона')
			));
			?>
		</div>
		<div class="row">
			<?php echo $form->emailField($model, 'email', array('class'=>'input', 'placeholder'=>'E-mail'));?>
		</div>
		<div class="row">
			<?php echo $form->textArea($model, 'message', array('class'=>'input'));?>
		</div>
		<?php echo CHtml::ajaxLink(
			"Подберите мне квартиру<i class='strelka'></i>", 
			'/catalog/sendForm', 
			array(
				'type' => 'POST',
				'success' => 'js:function(data){
					if(data != "ok"){
						$("#order").html(data);
						$("#order_sleeper-count").slider({
							range: "min",
							min: 1,
							max: 8,
							step: 1,
							create: function(event, ui){
								$(this).find(".ui-slider-handle").append($("<div class=\"sleeper_count-num\"></div>"));
							},
							slide: function( event, ui ) {	
								$(this).next().val(ui.value);
								$(this).find(".ui-slider-handle div").html(ui.value);	
							}
						});
						
						$("#order_sleeper-count").slider({ value: $("#order .human").val() });
						$("#order .sleeper_count-num").html($("#order .sleeper_count").slider("value"));
						console.log($("#order_sleeper-count").slider("value"));
					}
				}'
			), 
			array('class' => 'blue-button', 'id' => 'send-form')); ?>
	<?php $this->endWidget(); ?>
</div>

<?php
	Yii::app()->clientScript->registerScript('bookin_form', '

	');
?>