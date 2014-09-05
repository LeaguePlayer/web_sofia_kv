<?
if(!isset($ajax)){
	$model = new CallForm;
}

?>
<div class="booking-block booking-block-call">
	<header>
		<h1>Закажите звонок <strong>прямо сейчас!</strong></h1>
	</header>
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'fancy-activeform-call',
		'enableClientValidation'=>false,
		'clientOptions'=>array(
			//'validateOnSubmit'=>true,
		),
		'action' => '/catalog/fancyFormCall'
	)); ?>
		<div class="errors" style=""><?=$form->errorSummary($model)?></div>
		<div class="success" style="display: none;">
			<p class="upper">Спасибо за заказ звонка!<p>
			<p class="blue upper">мы свяжемся с Вами <br>В ближайшее время</p>
			<p class="button"><a href="#send" class="blue-button"><span>&nbsp;</span>Вернуться на сайт</a></p>
		</div>
		<table>
			<tr class="label">
				<td><?php echo $form->labelEx($model, 'fio'); ?></td>
			</tr>
			<tr class="inputs">
				<td><?php echo $form->textField($model, 'fio', array('class'=>'input fio'));?></td>
			</tr>
			<tr class="label">
				<td>
					<?php echo $form->labelEx($model, 'phone'); ?>
			</tr>
			<tr class="inputs">
				<td colspan="2" class="phone">
					<?php
						$this->widget('CMaskedTextField', array(
							'model' => $model,
							'attribute' => 'phone',
							'mask' => '+7 (999) 999-99-99',
							'id' => 'callphone',
							'htmlOptions' => array('class'=>'input', 'style' => 'width: 300px;')
						));
					?>
				</td>
				<!-- <td><input class="input" name="" type="text" value="4" ></td> -->
			</tr>
		</table>
		<div style="text-align: center; margin-bottom: 20px">
			<?php echo CHtml::ajaxLink(
				"<span></span>Заказать звонок", 
				'/catalog/fancyFormCall', 
				array(
					'type' => 'POST',
					'success' => 'js:function(data){
						if(data != "ok"){
							$(".fancybox-inner #fancy-form-call").html(data);
							$("#phone").mask("+7 (999) 999-99-99");
						}else{
							$.fancybox.open($(".fancybox-inner").find(".success"), {wrapCSS: "sofia-modal", modal: true});
							$(".sofia-modal .blue-button").click(function(){
								window.location = "'.Yii::app()->request->url.'";
							});
						}
					}'
				), 
				array('class' => 'blue-button call-button', 'id' => 'fancy-form-call-button')); 
			?>
		</div>

	<?php $this->endWidget(); ?>
</div>