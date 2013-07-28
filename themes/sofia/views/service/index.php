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

	<section id="order"><?php $this->renderPartial('/catalog/_booking_form');?></section>
</section>
<div class="clear"></div>