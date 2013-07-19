<section class="left">
	<?php $this->renderPartial('_filter', array('model' => $model, 'areas' => $areas));?>
	<a id="link-share" class="gray-button" href="#"><i class="plus-blue"></i> Квартиры в закладках</a>
	&nbsp;
</section>
<section id="catalog" class="right">
	<div class="rooms-count">
			<label class="text-title">смотреть только:</label>
			<a class="room1 <?=((isset($model->rooms_count[1]) && $model->rooms_count[1] != 0) ? "active" : "")?>" href="#">1 комнатные</a>
			<a class="room2 <?=((isset($model->rooms_count[2]) && $model->rooms_count[2] != 0) ? "active" : "")?>" href="#">2х комнатные</a>
			<a class="room3 <?=((isset($model->rooms_count[3]) && $model->rooms_count[3] != 0) ? "active" : "")?>" href="#">3х комнатные</a>
	</div>
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

<?php
Yii::app()->clientScript->registerScriptFile($this->themeUrl.'/js/catalog.js',  CClientScript::POS_END);
?>