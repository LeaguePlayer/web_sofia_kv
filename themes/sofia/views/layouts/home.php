<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<section class="center">
	<?php echo $this->getClip('main_menu');?>
	<?php echo $content; ?>
</section>
<section id="city">
	<?php foreach ($this->city_block_rooms as $value) {?>
		<span class="float"><?=yii::t('sofia', '{n} flat|{n} flats', $value['rooms_count'])?><br><span><?=CHtml::encode($value['price_24'])?>.-</span></span>
	<?}?>
	<!-- <span class="float">Однокомнатная<br><span>4200.-</span></span>
	<span class="float">2х комнатная<br><span>2200.-</span></span>
	<span class="float">3х комнатная<br><span>2300.-</span></span>
	<span class="float">Однокомнатная<br><span>4200.-</span></span>
	<span class="float">2х комнатная<br><span>2200.-</span></span>
	<span class="float">3х комнатная<br><span>2300.-</span></span>
	<span class="float">Однокомнатная<br><span>4200.-</span></span>
	<span class="float">2х комнатная<br><span>2200.-</span></span>
	<span class="float">3х комнатная<br><span>2300.-</span></span>
	<span class="float">Однокомнатная<br><span>4200.-</span></span>
	<span class="float">2х комнатная<br><span>2200.-</span></span>
	<span class="float">3х комнатная<br><span>2300.-</span></span> -->
	<div class="all"><?=yii::t('sofia', '{n} room|{n} rooms', count($this->city_block_rooms))?> на ваш выбор</div>
</section>
<?php $this->endContent(); ?>