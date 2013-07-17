<?php
$arrayAreas = array(0 => 'Выбрать район');
$arrayAreas += Chtml::listData($areas, 'id', 'name');
?>

<div class="filters">
	<?php $form = $this->beginWidget('CActiveForm', array(
	    'id'=>'catalog-filter',
	    'method'=>'post',
	    'action'=>'#catalog'
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
		<label class="text-title">количество спальных мест</label>
		<div id="sleeper-slider" class="sleeper_count">
			<!-- <div class="sleeper_count-num">2</div> -->
		</div>
		<?php echo $form->hiddenField($model, 'human_count', array('class' => 'human'));?>
		<label class="text-ot">от <b>1</b></label>
		<label class="text-do">от <b>8</b></label>
	</div>
	<div class="price">
		<label class="text-title">Цена</label>
		<div id="price_count"></div>
		<?php echo $form->hiddenField($model, 'price_24', array('class' => 'price'));?>
		<label class="text-ot">от <b>300</b></label>
		<label class="text-do">от <b>5000</b></label>
	</div>
	<div class="checkbox-dop">
		<label class="text-title">Дополнительно</label><br>
		<?foreach (Catalog::$classesFeatures as $key => $value) {?>
			<?php echo $form->checkBox($model, "features[$key]", array('id'=>$value, 'value'=>$key));?><label for="<?=$value?>"></label>
		<?}?>
	</div>
	<?php echo CHtml::submitButton('Подобрать квартиру', array('class' => 'blue-button'));?>
	<?php $this->endWidget(); ?>		
</div>