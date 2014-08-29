<div class="top-block no-margin-left">
	<h2>
		<a id="link-share" class="gray-button map" href="/favorites/"><i class="plus-gray"></i> Квартиры в закладках</a>
		<?=CHtml::encode($model->rooms_count)?>-комнатная квартира, ул.&nbsp;<?=CHtml::encode($model->address)?>
	</h2>
</div>
<div class="dops">
	<div class="dop">
			<label class="text-title">В квартире есть:</label><br>
			<?if(!empty($model->features)){?>
				<? $features = explode(',', $model->features);?>
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
				<b><? echo CHtml::encode(($model->cat_actions ? $model->cat_actions[0]->new_price : $model->price_24))?></b> руб. в сутки
			</div>
			<div class="col3-left">
				<b><?=CHtml::encode($model->price_night)?></b> руб. за ночь
			</div>
			<div class="col3-left">
				<b><?=CHtml::encode($model->price_hour)?></b> руб. за час
			</div>
			<div class="clear"></div>
		</div>
		<a class="go-to-map" href="<?=$this->createUrl('catalog/map',array('id'=>$model->id))?>">показать на карте</a>
</div>
<?php if($model->gallery->galleryPhotos){?>
<div id="images">
	<a class="link-addFavorites <?=(FavoritesController::is_room_exists($model->id) ? 'active' : '')?>" href="#" data-id="<?=$model->id?>"><span></span></a>
	<?if(isset($model->tour_3d)){?>
	<a class="tour-3d" href="/uploads/tours/<?=$model->tour_3d?>">3D Тур</a>
	<?}?>
	<a class="nextImage" href="#"></a>
	<a class="prevImage" href="#"></a>
	<a class="zoomImage" href="#"></a>
	<div class="big_images">
		<?php foreach ($model->gallery->galleryPhotos as $key => $value) {?>
			<a class="fancybox <?if($key == 0) echo 'active';?>" rel="group" href="<?=$value->getUrl('medium')?>">
				<img src="<?=$value->getUrl('_gallery_big')?>" alt="" />
			</a>
		<?}?>
	</div>
	<div class="small_images">
		<?php foreach ($model->gallery->galleryPhotos as $key => $value) {?>
			<a <?if($key == 0) echo 'class="active"';?> rel="group" href="#" style="background: url('<?=$value->getUrl('_gallery_mini')?>') center no-repeat;">
			</a>
		<?}?>
	</div>
</div>
<?}?>

<div id="fancy-room" style="display:none;"><?php $this->renderPartial('/catalog/_booking_room', array('room' => $model));?></div>

<div id="bron">
	<div class="text"><?=strip_tags($model->desc)?></div>
	<div class="button">
		<a href="#fancy-room" class="blue-button room-form"><i class="key"></i>Забронировать квартиру</a>
	</div>
</div>
<div class="social-share">
	<div class="text-title">поделиться с друзьями:</div>
	<?= $this->renderPartial('//site/_social'); ?>
</div>

<?if(count($data->getData()) > 0){?>
	<h1>Похожие квартиры</h1>
	<section id="apartments">
		<?php
		$this->widget('zii.widgets.CListView', array(
		    'dataProvider'=>$data,
		    'itemView'=>'_view',
		    'template'=>'{items}',
		    'cssFile'=>false,
		    'id'=>'catalog-list',
		    'emptyText'=>'<div class="nothing">Ничего не найдено.</div>'
		));
		?>
		<div class="clear"></div>
	</section>
	<div class="all">
		<a class="yellow-button" href="/catalog"><span></span>Смотреть все предложения</a>
	</div>
<?}?>
<div>
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

<?php
Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/jquery.fancybox.pack.js' ,CClientScript::POS_HEAD );
Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/jquery.animate-shadow-min.js' ,CClientScript::POS_HEAD );
Yii::app()->clientScript->registerCssFile($this->getAssetsUrl().'/css/fancybox/jquery.fancybox.css');

Yii::app()->clientScript->registerScript('catalog', '
	$(".tour-3d").fancybox({type: "swf", wrapCSS: "sofia-modal"});
', CClientScript::POS_READY);
?>