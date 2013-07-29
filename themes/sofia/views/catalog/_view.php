<?php
	$classes = 'link-addFavorites';
	if($this->getId() == 'favorites'){ // Favorites page
		$classes = 'link-removeFavorites';
	}else{ // other pages
		$classes .= FavoritesController::is_room_exists($data->id) ? ' active' : '';
	}
?>
<div class="room">
	<a class="<?=$classes?>" href="#" data-id="<?=$data->id?>"><span></span></a>
	<div class="room-images">
		<?=CHtml::link(CHtml::image($data->getPreviewImage('v2'), ""),array('catalog/view','id'=>$data->id))?>
	</div>
	<?=CHtml::link(CHtml::encode($data->rooms_count).' комнатная квартира, '.CHtml::encode($data->address), array('catalog/view','id'=>$data->id), array('class' => 'link-room')); ?>
	<div class="sleepers">
		<label><? echo CHtml::encode($data->human_count);?> спальн<? echo ($data->human_count == 1 ? 'ое' : 'ых');?> места</label>
		<? for($i = 0; $i < $data->human_count; $i++): ?>
			<i class="sleeper"></i>
		<? endfor; ?>
	</div>
	<div class="dop">
		<label class="text-title">Дополнительно</label><br>
		<?if(!empty($data->features)){?>
			<? $features = explode(',', $data->features);?>
			<?foreach ($features as $value):?>
			<div class="<?=Catalog::$classesFeatures[$value]?>-blue">
				<div class="title">
					<div class="top"></div>
					<div class="bottom"><?=Catalog::$allowFeatures[$value]?></div>
				</div>
			</div>
			<?endforeach;?>
		<?}?>
		
	</div>
	<div class="room-price">
		<div class="col3-left">
			<b><? echo CHtml::encode(($data->cat_actions ? $data->cat_actions[0]->new_price : $data->price_24))?></b> руб. в сутки
		</div>
		<div class="col3-left">
			<b><? echo CHtml::encode($data->price_night)?></b> руб. за ночь
		</div>
		<div class="col3-left">
			<b><? echo CHtml::encode($data->price_hour)?></b> руб. за час
		</div>
		<div class="clear"></div>
	</div>
</div>