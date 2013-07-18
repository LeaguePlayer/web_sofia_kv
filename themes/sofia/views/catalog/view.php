<div class="top-block no-margin-left">
	<h2><?=CHtml::encode($model->rooms_count)?>-комнатная квартира, <?=CHtml::encode($model->address)?></h2>
	<a id="link-share" class="gray-button" href="#"><i class="plus-gray"></i> Квартиры в закладках</a>
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
				<b><?=CHtml::encode($model->price_24)?></b> руб. в сутки
			</div>
			<div class="col3-left">
				<b><?=CHtml::encode($model->price_night)?></b> руб. за ночь
			</div>
			<div class="col3-left">
				<b><?=CHtml::encode($model->price_hour)?></b> руб. за час
			</div>
			<div class="clear"></div>
		</div>
		<a class="go-to-map" href="/catalog/map">показать на карте</a>
</div>
<?php if($model->gallery->galleryPhotos){?>
<div id="images">
	<a class="link-addFavorites" href="#"><span></span></a>
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

<div id="bron">
	<div class="text">Предлагаем вам в аренду квартиры на сутки и более. Каким бы ни был ваш выбор все квартиры с качественным ремонтом, меблированы, оборудованы бытовой техникой, чистые и уютные.</div>
	<div class="button">
		<a href="#" class="blue-button"><i class="key"></i>Забронировать квартиру</a>
	</div>
</div>
<div class="social-share">
	<div class="text-title">поделиться с друзьями:</div>
</div>
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
<div>
	<section class="left">
		<div class="text-left_title">специальные предложения:</div>
		<a class="spec" href="#"><img src="images/spec.jpg"></a>
		<a class="spec" href="#"><img src="images/spec.jpg"></a>
	</section>
	<section class="right">
		<section id="order">
			<div class="order-block">
				<header>
					<h1>Нет времени подбирать квартиру самостоятельно?</h1>
				</header>
				<form action="" method="POST">
				<div class="left">
					<div class="text-title">Количество комнат</div>
					<div class="row checkbox-rooms">
						<input type="checkbox" id="check1" /><label for="check1">1-комнатная</label>
						<input type="checkbox" id="check2" /><label for="check2">2-комнатная</label>
						<input type="checkbox" id="check3" /><label for="check3">3-комнатная</label>
					</div>
					<label class="text-title">Количество спальных мест</label>
					<div class="row sleeper">
						<div id="order_sleeper-count" class="sleeper_count">
							<div class="sleeper_count-num">2</div>
						</div>
						<input type="hidden" name="sleeper" value="2">
						<label class="text-ot">от <b>1</b></label>
						<label class="text-do">от <b>8</b></label>
					</div>
					<div class="row price">
						<label class="text-title">Цена</label>
						<input class="input" type="text" name="price">
						<span>рублей</span>
					</div>
					<div class="row days">
						<label class="text-title">Количество дней</label>
						<input class="input" type="number" name="days" min="0" value="4">
					</div>
				</div>
				<div class="right">
					<div class="row">
						<input class="input" type="text" value="ФИО">
					</div>
					<div class="row">
						<input class="input" type="text" value="Контактный номер телефона">
					</div>
					<div class="row">
						<input class="input" type="email" value="E-mail">
					</div>
					<div class="row">
						<textarea class="input">Комментарий</textarea>
					</div>
					<button class="blue-button" type="submit">Подберите мне квартиру<i class="strelka"></i></button>
				</div>
				</form>
			</div>
		</section>
	</section>
	<div class="clear"></div>
</div>

<?php
Yii::app()->clientScript->registerScriptFile($this->themeUrl.'/js/jquery.fancybox.pack.js' ,CClientScript::POS_HEAD );
Yii::app()->clientScript->registerScriptFile($this->themeUrl.'/js/jquery.animate-shadow-min.js' ,CClientScript::POS_HEAD );
Yii::app()->clientScript->registerCssFile($this->themeUrl.'/css/fancybox/jquery.fancybox.css');
?>