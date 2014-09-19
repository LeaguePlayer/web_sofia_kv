
<? if(!((strpos(Yii::app()->request->requestUri, 'service') !== FALSE) || (strpos(Yii::app()->request->requestUri, 'promo') !== FALSE))):?>
<?php
$arrayAreas = array(0 => 'Выбрать район');
$arrayAreas += Chtml::listData($areas, 'id', 'name');

$submit_text = $this->getId() == 'service' ? "Перейти к квартирам" : 'Подобрать квартиру';
$form_action = $this->getId() == 'service' ? '/catalog/#catalog' : '#catalog';
?>

<div class="filters">
	<?php $form = $this->beginWidget('CActiveForm', array(
	    'id'=>'catalog-filter',
	    'method'=>'post',
	    'action'=>$form_action
	)); ?>
	<h1>Подберите квартиру <strong>прямо сейчас!</strong></h1>
	<div class="select-style">
		<?php echo CHtml::dropDownList('area', (isset($_POST['area']) ? $_POST['area'] : 0), $arrayAreas, array('id'=>'region'));?>
	</div>
	<div class="checkbox-rooms">
		<?php echo $form->checkBox($model, 'rooms_count[1]', array('id'=>'checkbox1'));?><label for="checkbox1">1-комнатная</label>
		<?php echo $form->checkBox($model, 'rooms_count[2]', array('id'=>'checkbox2'));?><label for="checkbox2">2-комнатная</label>
		<?php echo $form->checkBox($model, 'rooms_count[3]', array('id'=>'checkbox3'));?><label for="checkbox3">3-комнатная</label>
	</div>
	<div class="sleeper">
		<label class="text-title">количество человек</label>
		<div id="sleeper-slider" class="sleeper_count">
			<!-- <div class="sleeper_count-num">2</div> -->
		</div>
		<?php echo $form->hiddenField($model, 'human_count', array('class' => 'human'));?>
		<label class="text-ot">от <b>1</b></label>
		<label class="text-do">до <b>10</b></label>
		<div class="small_text">Если Вас более 10 человек, просим связаться с нашим администратором по телефону для Тюмени 500-333, для других регионов 8-800-500-31-33</div>
	</div>
	<div class="price">
		<label class="text-title">Цена</label>
		<div id="price_count"></div>
		<?php echo $form->hiddenField($model, 'price_24', array('class' => 'price'));?>

		<label class="text-ot">от <b>1000</b></label>
		<label class="text-do">до <b>5000</b></label>
	</div>
	<div class="checkbox-dop">
		<label class="text-title">Дополнительно</label><br>
		<?foreach (Catalog::$classesFeatures as $key => $value) {?>
			<?php echo $form->checkBox($model, "features[$key]", array('id'=>$value, 'value'=>$key));?><label for="<?=$value?>"></label>
		<?}?>
	</div>
	<?php echo CHtml::submitButton($submit_text, array('class' => 'blue-button'));?>
	<?php $this->endWidget(); ?>		
</div>
<? endif; ?>