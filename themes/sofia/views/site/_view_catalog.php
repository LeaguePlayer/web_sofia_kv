<div class="image">
	<?=CHtml::link(CHtml::image($room->getPreviewImage('v1'), ""),array("catalog/view","id"=>$room->id))?>
	<a href="#zoom" class="zoom" data-id="room<?=$room->id?>"></a><?//CHtml::link(CHtml::image($data->getPreviewImage('v2'), ""),array("view","id"=>$data->id))?>
	<?=CHtml::link(CHtml::encode($room->rooms_count).' комнатная квартира, '.CHtml::encode($room->address), array("catalog/view","id"=>$room->id), array('class' => 'link-room'))?>
	<div class="room-price">
		<div class="col3-left">
			<b><?=CHtml::encode($room->price_24)?></b> руб. в сутки
		</div>
		<div class="col3-left">
			<b><?=CHtml::encode($room->price_night)?></b> руб. за ночь
		</div>
		<div class="col3-left">
			<b><?=CHtml::encode($room->price_hour)?></b> руб. за час
		</div>
		<div class="clear"></div>
	</div>
	<?//hidden photos?>
	<?if($room->gallery->galleryPhotos){?>
		<?php foreach ($room->gallery->galleryPhotos as $key => $value) {?>
			<a class="fancybox room<?=$room->id?>" rel="room<?=$room->id?>" href="<?=$value->getUrl('medium')?>" style="display:none;"></a>
		<?}?>
	<?}?>
</div>