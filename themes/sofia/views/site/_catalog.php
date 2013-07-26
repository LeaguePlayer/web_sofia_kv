<? $item = call_user_func(array($block->model, 'model'))->findByPk($block->model_id);?>
<div class="<?=($i == 0 ? 'big' : 'small')?>">
	<? $preview = ($i == 0 ? 'big' : 'small'); ?>
	<a href="<?=$this->createUrl('/catalog/view', array('id'=>$item->id))?>">
		<img src="<?=CHtml::encode($block->getPreview($preview))?>" alt="" />
		<div class="info-room">
			<?/*if($key == 0){?><div class="action_label"></div><?}*/?>
			<div class="title">
				<h2><?=CHtml::encode($item->address)?></h2>
				<div><?=CHtml::encode(strip_tags($item->desc))?></div>
			</div>
		</div>
		<?/*if($key != 0){?><div class="action_label"></div><?}*/?>
	</a>
</div>