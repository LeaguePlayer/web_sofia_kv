<? $item = call_user_func(array($block->model, 'model'))->findByPk($block->model_id);?>
<div class="<?=($i == 0 ? 'big' : 'small')?>">
	<? $preview = ($i == 0 ? 'big' : 'small'); ?>
	<a href="<?=$this->createUrl('/promo/view', array('id'=>$item->id))?>">
		<img src="<?=CHtml::encode($block->getPreview($preview))?>" alt="" />
		<div class="info-room">
			<?if($i == 0){?><div class="action_label"></div><?}?>
			<div class="title">
				<h2><?=CHtml::encode($item->name)?></h2>
				<div><?=CHtml::encode($item->short_desc)?></div>
			</div>
		</div>
		<?if($i != 0){?><div class="action_label"></div><?}?>
	</a>
</div>