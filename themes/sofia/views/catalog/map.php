<div class="top-block no-margin-left">
	<a id="link-share" class="gray-button map" href="#"><i class="plus-gray"></i> Квартиры в закладках</a>
	<div class="rooms-count no-margin-left">
		<label class="text-title">смотреть только:</label>
		<a class="room1" href="#">1 комнатные</a>
		<a class="room2" href="#">2х комнатные</a>
		<a class="room3" href="#">3х комнатные</a>
	</div>
</div>
<div class="filters-map">
	<section class="left">
		<?php $this->renderPartial('_filter', array('model' => $model, 'areas' => $areas));?>
	</section>
</div>
<div id="map" data-id="<?=Yii::app()->getRequest()->getParam('id')?>" data-assets="<?=$this->getAssetsUrl()?>"></div>
<div class="afterMap">
	<section class="left">
		<div class="text-left_title">специальные предложения:</div>
		<a class="spec" href="#"><img src="images/spec.jpg"></a>
		<a class="spec" href="#"><img src="images/spec.jpg"></a>
	</section>
	<section class="right">
		<section id="order"><?php $this->renderPartial('/catalog/_booking_form');?></section>
	</section>
	<div class="clear"></div>
</div>
<?php Yii::app()->clientScript->registerCssFile($this->getAssetsUrl().'/css/map.css' );?>
<?php Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU' ,CClientScript::POS_HEAD );?>
<?php Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/map.js' ,CClientScript::POS_END );?>
<?php Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/catalog.js' ,CClientScript::POS_END );?>