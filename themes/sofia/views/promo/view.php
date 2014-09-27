<section class="left">
	<?php $this->renderPartial('/catalog/_filter', array('model' => $model, 'areas' => $areas));?>
	
	<script type="text/javascript">
		defaultFilterMin = 1000;
	</script>					
</section>
<section class="right">
	<div class="top-block">
		<h2><a id="link-share" class="gray-button map" href="/favorites/"><i class="plus-gray"></i> Квартиры в закладках</a><?=CHtml::encode($action->name)?></h2>
		<?if($fixed_price){?><div class="oldPrice">вместо <span><?=CHtml::encode($fixed_price)?></span></div><?}?>
		
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
		<? $action->long_desc ? echo $action->long_desc : echo $action->short_desc; ?>
	</section>

	<section id="order"><?php $this->renderPartial('/catalog/_booking_form');?></section>
</section>
<div class="clear"></div>