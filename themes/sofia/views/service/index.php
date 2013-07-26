<section class="left">
	<?php $this->renderPartial('/catalog/_filter', array('model' => $model, 'areas' => $areas));?>
</section>
<section class="right">
	<div class="top-block">
		<h2>Мы рады предложить своим клиентам</h2>
	</div>
	<div class="service-row">
		<div class="img">
			<img src="<?=$this->getAssetsUrl()?>/images/services.jpg" />
		</div>
		<div class="content">
			<h2>Клубный отдых в отеле</h2>
			<p>Предлагаем вам в аренду квартиры на сутки и более. Каким бы ни был ваш выбор все квартиры с качественным ремонтом, меблированы, оборудованы бытовой техникой, чистые и уютные.</p>
		</div>
		<div class="clear"></div>
	</div>
	<div class="service-row">
		<div class="img">
			<img src="<?=$this->getAssetsUrl()?>/images/services2.jpg" />
		</div>
		<div class="content">
			<h2>Оформление командировочных документов</h2>
			<p>Предлагаем вам в аренду квартиры на сутки и более. Каким бы ни был ваш выбор все квартиры с качественным ремонтом, меблированы, оборудованы бытовой техникой, чистые и уютные.</p>
		</div>
		<div class="clear"></div>
	</div>
	<div class="service-row">
		<div class="img">
			<img src="<?=$this->getAssetsUrl()?>/images/services3.jpg" />
		</div>
		<div class="content">
			<h2>Бесплатный трансфер</h2>
			<p>Предлагаем вам в аренду квартиры на сутки и более. Каким бы ни был ваш выбор все квартиры с качественным ремонтом, меблированы, оборудованы бытовой техникой, чистые и уютные.</p>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>

	<section id="relax-type">
		<h1>Не знаете где и как отдохнуть в тюмени?</h1>
		<h4>Спланируйте свой отдых тут:</h4>
		<div>
			<div class="col3">
				<header><span>рестораны</span></header>
				<a href="#">tumen.gorko.ru</a>
			</div>
			<div class="col3">
				<header><span>заказ еды</span></header>
				<a href="#">tumen.gorko.ru</a>
			</div>
			<div class="col3">
				<header><span>покупки</span></header>
				<a href="#">tumen.gorko.ru</a>
			</div>
			<div class="col3">
				<header><span>рестораны</span></header>
				<a href="#">tumen.gorko.ru</a>
			</div>
			<div class="col3">
				<header><span>заказ еды</span></header>
				<a href="#">tumen.gorko.ru</a>
			</div>
			<div class="col3">
				<header><span>покупки</span></header>
				<a href="#">tumen.gorko.ru</a>
			</div>
			<div class="clear"></div>
		</div>
	</section>

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
					<div id="order_sleeper-count" class="sleeper_count"></div>
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