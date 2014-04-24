<? $item = $block->getAttachedModel();?>
<img width="1000" src="<?= CHtml::encode($block->getPreview('medium')) ?>" alt="" />
<div class="info-room">
	<div class="title">
		<h2><?=CHtml::encode($item->address)?></h2>
		<div><?=CHtml::encode(strip_tags($item->desc))?></div>
	</div>
	<a class="blue-button" href="<?=$this->createUrl('/catalog/view', array('id'=>$item->id))?>">Перейти</a>
</div>