<section class="left">
	<?php $this->renderPartial('/catalog/_filter', array('model' => $model, 'areas' => $areas));?>			
</section>
<section class="right">
	<div class="top-block">
		<h2><?=CHtml::encode($action->name)?></h2>
		<div class="oldPrice">вместо <span>1500</span></div>
		<a id="link-share" class="gray-button" href="#"><i class="plus-gray"></i> Квартиры в закладках</a>
	</div>
	<?php
	/*foreach ($action->action_rooms as $item) {
		$this->renderPartial('/catalog/_view', array('data' => $item));
	}*/
	$this->widget('zii.widgets.CListView', array(
	    'dataProvider'=>$action_rooms,
	    'itemView'=>'/catalog/_view',
	    'template'=>'{items}',
	    'cssFile'=>false,
	    'id'=>'catalog-list',
	    'emptyText'=>'<div class="nothing">Ничего не найдено.</div>'
	));
	?>
	<div class="clear"></div>

	<section id="text-content">
		<?=$action->long_desc?>
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