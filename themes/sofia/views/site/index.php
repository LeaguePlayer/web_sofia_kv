
<? $this->renderPartial('_main_blocks', array('main_blocks' => $main_blocks)); ?>
<section id="features">
	<header>
		<h1>Наши преимущества</h1>
	</header>
	<ul id="items">
		<li>
            <a href="<?= $this->createUrl('/page/view', array('alias' => 'contacts')) ?>">
                <span class="i1 icon"></span>
                <span class="title">Демократичная цена</span>
            </a>
		</li>
		<li>
            <a href="<?= $this->createUrl('/page/view', array('alias' => 'contacts')) ?>">
                <span class="i2 icon"></span>
                <span class="title">Дополнительный сервис</span>
            </a>
		</li>
		<li>
            <a href="<?= $this->createUrl('/page/view', array('alias' => 'contacts')) ?>">
                <span class="i3 icon"></span>
                <span class="title">Удобное  расположение</span>
            </a>
		</li>
		<li>
            <a href="<?= $this->createUrl('/page/view', array('alias' => 'contacts')) ?>">
                <span class="i4 icon"></span>
                <span class="title">Документы для отчетности</span>
            </a>
		</li>
	</ul>
</section>
<hr>
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
					<div class="title"><?=($key+1)?> комнатные</div>
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
<!--	<header>-->
<!--		<h1>Наши партнеры</h1>-->
<!--	</header>-->
<!--	<div id="slider-block">-->
<!--		<a class="left" href="#left"></a>-->
<!--		<a class="right show" href="#left"></a>-->
<!--		<div class="slider-box">-->
<!--			<div class="slider">-->
<!--				<div class="item" style="background-image: url('--><?//=$this->getAssetsUrl()?><!--/images/tmp/apple.png');"></div>-->
<!--				<div class="item" style="background-image: url('--><?//=$this->getAssetsUrl()?><!--/images/tmp/fb.png');"></div>-->
<!--				<div class="item" style="background-image: url('--><?//=$this->getAssetsUrl()?><!--/images/tmp/apple.png');"></div>-->
<!--				<div class="item" style="background-image: url('--><?//=$this->getAssetsUrl()?><!--/images/tmp/fb.png');"></div>-->
<!--				<div class="item" style="background-image: url('--><?//=$this->getAssetsUrl()?><!--/images/tmp/apple.png');"></div>-->
<!--				<div class="item" style="background-image: url('--><?//=$this->getAssetsUrl()?><!--/images/tmp/fb.png');"></div>-->
<!--				<div class="item" style="background-image: url('--><?//=$this->getAssetsUrl()?><!--/images/tmp/fb.png');"></div>-->
<!--				<div class="item" style="background-image: url('--><?//=$this->getAssetsUrl()?><!--/images/tmp/apple.png');"></div>-->
<!--				<div class="item" style="background-image: url('--><?//=$this->getAssetsUrl()?><!--/images/tmp/fb.png');"></div>-->
<!--				<div class="item" style="background-image: url('--><?//=$this->getAssetsUrl()?><!--/images/tmp/fb.png');"></div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
</section>
<section id="booking">
	<?php //$this->renderPartial('_booking_form_main');?>
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
?>