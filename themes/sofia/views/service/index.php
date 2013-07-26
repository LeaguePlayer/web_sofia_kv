<section class="left">
	<div class="filters promo">
		<form>
		<h1>Подберите квартиру <strong>прямо сейчас!</strong></h1>
		<div class="select-style">
			<select id="region">
				<option value="0">Выбрать район</option>
				<option value="1">Калининский район</option>
				<option value="2">Центральный район</option>
				<option value="3">Южный район</option>
			</select>
		</div>
		<div class="checkbox-rooms">
			<input type="checkbox" id="checkbox1" /><label for="checkbox1">1-комнатная</label>
			<input type="checkbox" id="checkbox2" /><label for="checkbox2">2-комнатная</label>
			<input type="checkbox" id="checkbox3" /><label for="checkbox3">3-комнатная</label>
		</div>
		<div class="sleeper">
			<label class="text-title">количество спальных мест</label>
			<div id="sleeper-slider" class="sleeper_count">
				<div class="sleeper_count-num">2</div>
			</div>
			<input type="hidden" name="sleeper_count" value="2">
			<label class="text-ot">от <b>1</b></label>
			<label class="text-do">от <b>8</b></label>
		</div>
		<div class="price">
			<label class="text-title">Цена</label>
			<div id="price_count">
				<div id="price_count-num">800</div>
			</div>
			<input type="hidden" name="price_count" value="2">
			<label class="text-ot">от <b>300</b></label>
			<label class="text-do">от <b>5000</b></label>
		</div>
		<div class="checkbox-dop">
			<div class="text-title">Дополнительно</div>
			<label class="active"><input type="checkbox" id="wifi" /><label for="wifi"></label>Wi-Fi</label>
			<label><input type="checkbox" id="tele" /><label for="tele"></label>Кабельное телевиденье</label>
			<label><input type="checkbox" id="wash" /><label for="wash"></label>Стиральная машина</label>
			<label><input type="checkbox" id="iron" /><label for="iron"></label>Утюг</label>
		</div>
		<input type="submit" class="blue-button" value="Подобрать квартиру">
		</form>				
	</div>
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