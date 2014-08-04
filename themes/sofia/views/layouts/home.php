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
    <a href="<?= $this->createUrl('catalog/index', array('Catalog[rooms_count][1]' => true)) ?>" class="badge one-room" style="top:122px; left:-6px;"></a>
    <a href="<?= $this->createUrl('catalog/index', array('Catalog[rooms_count][2]' => true)) ?>" class="badge two-room" style="top:233px; left:225px;"></a>
    <a href="<?= $this->createUrl('catalog/index', array('Catalog[rooms_count][3]' => true)) ?>" class="badge three-room" style="top:122px; left:404px;"></a>
    <a href="<?= $this->createUrl('catalog/index', array('Catalog[rooms_count][2]' => true)) ?>" class="badge two-room" style="top:292px; left:817px;"></a>
    <a href="<?= $this->createUrl('catalog/index', array('Catalog[rooms_count][1]' => true)) ?>" class="badge one-room" style="top:234px; left:1049px;"></a>

	<div class="all"><?=yii::t('sofia', '{n} room|{n} rooms', count(Catalog::model()->findAll('active=1 AND price_24 > 0')))?> на ваш выбор</div>
</section>
<?php $this->endContent(); ?>