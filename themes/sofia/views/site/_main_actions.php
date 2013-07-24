<div id="recent">
	<?foreach ($actions as $key => $action):?>
	<div class="<?=($key == 0 ? 'big' : 'small')?>">
		<? $preview = ($key == 0 ? 'big' : 'v1'); ?>
		<a href="<?=$this->createUrl('/promo/view', array('id'=>$action->id))?>">
			<img src="<?=CHtml::encode($action->getPreviewImage($preview))?>" alt="" />
			<div class="info-room">
				<?if($key == 0){?><div class="action_label"></div><?}?>
				<div class="title">
					<h2><?=CHtml::encode($action->name)?></h2>
					<div><?=CHtml::encode($action->short_desc)?></div>
				</div>
			</div>
			<?if($key != 0){?><div class="action_label"></div><?}?>
		</a>
	</div>
	<?endforeach;?>
	
	<!-- <div class="small">
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
	</div> -->
	<div class="clear"></div>
</div>