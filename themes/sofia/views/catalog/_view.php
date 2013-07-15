<div class="room">
	<a class="link-addFavorites" href="#"><span></span></a>
	<div class="room-images">
		<?=$data->gallery->main ? CHtml::link(CHtml::image($data->gallery->main->getUrl('v2'), ""),array("view","id"=>$data->id)) : ""?>
	</div>
	<?=CHtml::link(CHtml::encode($data->rooms_count).' комнатная квартира, '.CHtml::encode($data->address), array('view','id'=>$data->id), array('class' => 'link-room')); ?>
	<div class="sleepers">
		<label><? echo CHtml::encode($data->human_count);?> спальн<? echo ($data->human_count == 1 ? 'ое' : 'ых');?> места</label>
		<? for($i = 0; $i < $data->human_count; $i++): ?>
			<i class="sleeper"></i>
		<? endfor; ?>
	</div>
	<div class="dop">
		<label class="text-title">Дополнительно</label><br>
		<? $features = explode(',', $data->features);?>

		<?foreach ($features as $value):?>
		<div class="<?=Catalog::$classesFeatures[$value]?>-blue">
			<div class="title">
				<div class="top"></div>
				<div class="bottom"><?=Catalog::$allowFeatures[$value]?></div>
			</div>
		</div>
		<?endforeach;?>
	</div>
	<div class="room-price">
		<div class="col3-left">
			<b><? echo CHtml::encode($data->price_24)?></b> руб. в сутки
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