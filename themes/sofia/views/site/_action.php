<? $item = $block->getAttachedModel();?>
<img src="<?= CHtml::encode($block->getPreview('medium')) ?>" alt="" />
<div class="info-room">
	<div class="title">
		<h2><?=CHtml::encode($item->name)?></h2>
		<div><?=CHtml::encode($item->short_desc)?></div>
	</div>
	<a class="blue-button" href="<?=$this->createUrl('/promo/view', array('id'=>$item->id))?>">Перейти</a>
</div>