<?
if(!isset($ajax)){
	$model = new BookingForm;
	$model->days = 1;
	$model->rooms_count = 1;
}

?>
<div class="booking-block">
	<header>
		<h1>Оставьте заявку <strong>прямо сейчас!</strong></h1>
	</header>
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'fancy-activeform',
		'enableClientValidation'=>false,
		'clientOptions'=>array(
			//'validateOnSubmit'=>true,
		),
		'action' => '/catalog/fancyForm'
	)); ?>
		<div class="errors" style=""><?=$form->errorSummary($model)?></div>
		<div class="success" style="display: none;">
			<p class="upper">Ваша заявка принята,Спасибо!<p>
			<p class="blue upper">мы свяжемся с Вами, <br>В ближайшее время</p>
			<p class="button"><a href="#send" class="blue-button"><span>&nbsp;</span>Вернуться на сайт</a></p>
		</div>
		<table>
			<tr class="label">
				<td><?php echo $form->labelEx($model, 'fio'); ?></td>
				<td class="small"><?php echo $form->labelEx($model, 'date');?></td>
				<td class="small"><?php echo $form->labelEx($model, 'days'); ?></td>
			</tr>
			<tr class="inputs">
				<td><?php echo $form->textField($model, 'fio', array('class'=>'input fio', 'style' => 'margin-right: 20px;'));?></td>
				<td>
					<?php
					$this->widget('zii.widgets.jui.CJuiDatePicker',array(
					    'attribute'=>'date',
					    'model' => $model,
					    'language' => 'ru',
					    'id' => 'date',
					    'cssFile' => false,
					    // additional javascript options for the date picker plugin
					    'options'=>array(
					        'showAnim'=>'fold',
					        'dateFormat'=>'dd.mm.yy',
					        'minDate'=>0
					    ),
					    'htmlOptions'=>array(
					        'class'=>'input',
					    ),
					));
					?>
					<?php //echo $form->textField($model, 'date', array('class'=>'input'));?></td>
				<td><?php echo $form->numberField($model, 'days', array('class'=>'number counter input'));?></td>
			</tr>
			<tr class="label">
				<td colspan="2">
					<?php echo $form->labelEx($model, 'phone', array('style' => 'margin-right: 110px;')); ?>
					<?php echo $form->labelEx($model, 'email'); ?></td>
				<td><?php echo $form->labelEx($model, 'rooms_count'); ?></td>
			</tr>
			<tr class="inputs">
				<td colspan="2" class="phone">
					<?php
						$this->widget('CMaskedTextField', array(
							'model' => $model,
							'attribute' => 'phone',
							'mask' => '+7 (999) 999-99-99',
							'id' => 'phone',
							'htmlOptions' => array('class'=>'input', 'style' => 'width: 200px; margin-right: 30px;')
						));
					?>
					<?php echo $form->textField($model, 'email', array('class'=>'input'));?>
				</td>
				<td>
					<?php echo $form->numberField($model, 'rooms_count', array('class'=>'number counter input', 'min'=>'1', 'max'=>'3'));?>
				</td>
				<!-- <td><input class="input" name="" type="text" value="4" ></td> -->
			</tr>
			<tr class="label">
				<td colspan="3" class="small"><label>Комментарий</label></td>
			</tr>
			<tr class="inputs">
				<td colspan="3"><?php echo $form->textArea($model, 'message', array('class'=>'input'));?></td>
			</tr>
		</table>
		<div style="text-align: center; margin-bottom: 20px">
			<?php echo CHtml::ajaxLink(
				"<span></span>Отправить заявку", 
				'/catalog/fancyForm', 
				array(
					'type' => 'POST',
					'success' => 'js:function(data){
						console.log(data);
						if(data != "ok"){
							//console.log(data);
							$(".fancybox-inner #fancy-form").html(data);
							$("#phone").mask("+7 (999) 999-99-99");
							jQuery("#date").datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional["ru"],{"showAnim":"fold","dateFormat":"dd.mm.yy","minDate":0}));
							console.log(jQuery.datepicker.regional["ru"]);
							//$.fancybox.reposition()
						}else{
							$.fancybox.open($(".fancybox-inner").find(".success"), {wrapCSS: "sofia-modal", modal: true});
							$(".sofia-modal .blue-button").click(function(){
								window.location = "'.Yii::app()->request->url.'";
							});
						}
					}'
				), 
				array('class' => 'blue-button', 'id' => 'fancy-form-button')); 
			?>
		</div>

	<?php $this->endWidget(); ?>
</div>