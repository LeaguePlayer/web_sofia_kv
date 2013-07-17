<div class="top-block no-margin-left">
	<a id="link-share" class="gray-button map" href="#"><i class="plus-gray"></i> Квартиры в закладках</a>
	<div class="rooms-count no-margin-left">
		<label class="text-title">смотреть только:</label>
		<a class="room1" href="#">1 комнатные</a>
		<a class="active room2" href="#">2х комнатные</a>
		<a class="room3" href="#">3х комнатные</a>
	</div>
</div>
<div class="filters-map">
	<section class="left">
		<?php $this->renderPartial('_filter', array('model' => $model, 'areas' => $areas));?>
	</section>
</div>
<div id="map"></div>
<div class="afterMap">
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
<?php Yii::app()->clientScript->registerCssFile($this->themeUrl.'/css/map.css' );?>
<?php Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU' ,CClientScript::POS_HEAD );?>
<?php Yii::app()->clientScript->registerScriptFile($this->themeUrl.'/js/map.js' ,CClientScript::POS_END );?>