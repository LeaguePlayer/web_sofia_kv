<section class="left">
	<div class="filters">
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
			<label class="text-title">Дополнительно</label><br>
			<input type="checkbox" id="wifi" /><label for="wifi"></label>
			<input type="checkbox" id="tele" /><label for="tele"></label>
			<input type="checkbox" id="wash" /><label for="wash"></label>
			<input type="checkbox" id="iron" /><label for="iron"></label>
		</div>
		<input type="submit" class="blue-button" value="Подобрать квартиру">
		</form>				
	</div>
	<a id="link-share" class="gray-button" href="#"><i class="plus-blue"></i> Квартиры в закладках</a>
	&nbsp;
</section>
<section class="right">
	<div class="rooms-count">
			<label class="text-title">смотреть только:</label>
			<a class="room1" href="#">1 комнатные</a>
			<a class="active room2" href="#">2х комнатные</a>
			<a class="room3" href="#">3х комнатные</a>
	</div>
	<?php
	$this->widget('zii.widgets.CListView', array(
	    'dataProvider'=>$data,
	    'itemView'=>'_view',   // refers to the partial view named '_post'
	));
	?>
	<div class="clear"></div>
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