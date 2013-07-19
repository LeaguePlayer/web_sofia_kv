
<div id="recent">
	<div class="big">
		<a href="#">
			<img src="<?=$this->getAssetsUrl()?>/images/tmp/big_image.png" alt="" />
			<div class="info-room">
				<div class="action_label"></div>
				<div class="title">
					<h2>Предложение недели</h2>
					<div>Квартира с евро-ремонтом и джакузи</div>
				</div>
			</div>
		</a>
	</div>
	<div class="small">
		<a href="#">
			<img src="<?=$this->getAssetsUrl()?>/images/tmp/mini.jpg" alt="" />
			<div class="info-room">
				<div class="title">
					<h2>2х комнатная</h2>
					<div>Повышенный комфорт</div>
				</div>
				<div class="price">3 500 .-</div>
			</div>
		</a>
	</div>
	<div class="small">
		<a href="#">
			<img src="<?=$this->getAssetsUrl()?>/images/tmp/mini.jpg" alt="" />
			<div class="info-room">
				<div class="title">
					<h2>2х комнатная</h2>
					<div>Повышенный комфорт</div>
				</div>
				<div class="price">3 500 .-</div>
			</div>
		</a>
	</div>
	<div class="small">
		<a href="#">
			<img src="<?=$this->getAssetsUrl()?>/images/tmp/mini.jpg" alt="" />
			<div class="info-room">
				<div class="title">
					<h2>2х комнатная</h2>
					<div>Повышенный комфорт</div>
				</div>
				<div class="price">3 500 .-</div>
			</div>
			<div class="action_label"></div>
		</a>
	</div>
	<div class="clear"></div>
</div>
<section id="features">
	<header>
		<h1>Наши преимущества</h1>
	</header>
	<ul id="items">
		<li>
			<span class="i1 icon"></span>
			<span class="title">Демократичная цена</span>
		</li>
		<li>
			<span class="i2 icon"></span>
			<span class="title">Дополнительный сервис</span>
		</li>
		<li>
			<span class="i3 icon"></span>
			<span class="title">Удобное  расположение</span>
		</li>
		<li>
			<span class="i4 icon"></span>
			<span class="title">Документы для отчетности</span>
		</li>
	</ul>
</section>
<section id="rooms-on-main">
	<header>
		<h1>Наши квартиры</h1>
	</header>
	<div class="rooms">
		<form method="post" action="/catalog">
		<?foreach ($mainRooms as $key => $rooms) {?>	
			<?if (!empty($rooms)){?>
			<div class="room-block">
				<?=CHtml::activeHiddenField(new Catalog, 'rooms_count['.($key+1).']', array('value' => 0))?>
				<a href="#" class="filter">
					<div class="icon">
						<span></span>
						<?if($key != 0){
							for($i=0; $i<$key; $i++) echo '<span class="shift"></span>';
						}?>
					</div>
					<div class="title"><?=($key+1)?><?=($key != 1 ? "х" : "")?> комнатные</div>
				</a>
				<?foreach ($rooms as $room) {
					$this->renderPartial('_view_catalog', array('room' => $room));	
				}?>
			</div>	
			<?}?>
		<?}?>
		</form>
		<div class="clear"></div>
	</div>
	<div class="all">
		<a class="yellow-button" href="/catalog"><span></span>Смотреть все квартиры</a>
	</div>
</section>
<section id="pairs">
	<header>
		<h1>Наши партнеры</h1>
	</header>
	<div id="slider-block">
		<a class="left" href="#left"></a>
		<a class="right show" href="#left"></a>
		<div class="slider-box">
			<div class="slider">
				<div class="item" style="background-image: url('<?=$this->getAssetsUrl()?>/images/tmp/apple.png');"></div>
				<div class="item" style="background-image: url('<?=$this->getAssetsUrl()?>/images/tmp/fb.png');"></div>
				<div class="item" style="background-image: url('<?=$this->getAssetsUrl()?>/images/tmp/apple.png');"></div>
				<div class="item" style="background-image: url('<?=$this->getAssetsUrl()?>/images/tmp/fb.png');"></div>
				<div class="item" style="background-image: url('<?=$this->getAssetsUrl()?>/images/tmp/apple.png');"></div>
				<div class="item" style="background-image: url('<?=$this->getAssetsUrl()?>/images/tmp/fb.png');"></div>
				<div class="item" style="background-image: url('<?=$this->getAssetsUrl()?>/images/tmp/fb.png');"></div>
				<div class="item" style="background-image: url('<?=$this->getAssetsUrl()?>/images/tmp/apple.png');"></div>
				<div class="item" style="background-image: url('<?=$this->getAssetsUrl()?>/images/tmp/fb.png');"></div>
				<div class="item" style="background-image: url('<?=$this->getAssetsUrl()?>/images/tmp/fb.png');"></div>
			</div>
		</div>
	</div>
</section>
<section id="booking">
	<div class="booking-block">
		<header>
			<h1>Забронируйте вашу квартиру <strong>прямо сейчас!</strong></h1>
		</header>
		<form action="" method="POST">
			<table>
				<tr class="label">
					<td class="small"><label>Количество комнат</label></td>
					<td colspan="2"><label>Ваше ФИО</label></td>
				</tr>
				<tr class="inputs">
					<td><input class="number counter input" name="" type="number" min="1" max="3" value="1"></td>
					<td colspan="2"><input class="input fio" name="" type="text" value="4"></td>
				</tr>
				<tr class="label">
					<td class="small"><label>Количество дней</label></td>
					<td><label>Номер телефона</label></td>
					<td><label>Электронная почта</label></td>
				</tr>
				<tr class="inputs">
					<td><input class="number counter input" name="" type="number" value="4"></td>
					<td class="phone">
						<input class="input number beg" name="" type="text" value="4" maxlength="3">
						<input class="input number end" name="" type="text" value="4" maxlength="7">
					</td>
					<td><input class="input" name="" type="text" value="4" ></td>
				</tr>
				<tr class="label">
					<td colspan="3" class="small"><label>Комментарий</label></td>
				</tr>
				<tr class="inputs">
					<td colspan="3"><textarea></textarea></td>
				</tr>
			</table>
			<a href="#submit" class="blue-button"><span></span>Отправить заявку</a>
		</form>
	</div>
	<div class="msg">Оставьте заявку прямо сейчас, мы обработаем её и свяжемся с Вами!</div>
</section>
<?php
Yii::app()->clientScript->registerScript('#main_page', '
	$(".room-block a.filter").click(function(e){
		e.preventDefault();
		$(this).closest("form").find("input").val(0);
		$(this).closest(".room-block").find("input").val(1);
		$(this).closest("form").submit();
	});

	$(".image .zoom").click(function(e){
		e.preventDefault();
		$.fancybox.open(jQuery("." + $(this).data("id")));
	});
', CClientScript::POS_READY);

Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/jquery.fancybox.pack.js', CClientScript::POS_HEAD );
//Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/jquery.animate-shadow-min.js' ,CClientScript::POS_HEAD );
Yii::app()->clientScript->registerCssFile($this->getAssetsUrl().'/css/fancybox/jquery.fancybox.css');
?>