<? $item = call_user_func(array($block->model, 'model'))->findByPk($block->model_id);?>
<div class="<?=($i == 0 ? 'big' : 'small')?>">
	<? $preview = ($i == 0 ? 'big' : 'small'); ?>
	<a href="<?=$this->createUrl('/page/view', array('alias'=>$item->alias))?>">
		<img src="<?=CHtml::encode($block->getPreview($preview))?>" alt="" />
		<div class="info-room">
			<div class="title">
				<h2><?=CHtml::encode($item->title)?></h2>
				<div><?//CHtml::encode($item->short_desc)?></div>
			</div>
		</div>
	</a>
</div>