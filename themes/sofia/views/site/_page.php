<? $item = $block->getAttachedModel();?>
<img width="1000" src="<?= CHtml::encode($block->getPreview('medium')) ?>" alt="" />
<div class="info-room">
	<div class="title">
		<h2><?=CHtml::encode($item->title)?></h2>
		<div><?//=CHtml::encode($item->short_desc)?></div>
	</div>
	<a class="blue-button" href="<?=$this->createUrl('/page/view', array('alias'=>$item->alias))?>">Перейти</a>
</div>
