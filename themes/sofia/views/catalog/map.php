
<div id="map" data-id="<?=Yii::app()->getRequest()->getParam('id')?>" data-assets="<?=$this->getAssetsUrl()?>"></div>
<div class="afterMap">
	<?if($action){?>
	<section class="left">
		<div class="text-left_title">специальные предложения:</div>
		<a class="spec" href="<?=$this->createUrl('/promo/view', array('id' => $action->id))?>"><img src="<?=CHtml::encode($action->getPreviewImage('v2'))?>"></a>
	</section>
	<?}?>
	<section class="right">
		<section id="order" <?=($action ? '' : 'style="margin-left: 160px"')?>><?php $this->renderPartial('/catalog/_booking_form');?></section>
	</section>
	<div class="clear"></div>
</div>
<?php Yii::app()->clientScript->registerCssFile($this->getAssetsUrl().'/css/map.css' );?>
<?php Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU' ,CClientScript::POS_HEAD );?>
<?php Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/map.js' ,CClientScript::POS_END );?>
<?php Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/catalog.js' ,CClientScript::POS_END );?>