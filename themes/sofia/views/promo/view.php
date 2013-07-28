<section class="left">
	<?php $this->renderPartial('/catalog/_filter', array('model' => $model, 'areas' => $areas));?>			
</section>
<section class="right">
	<div class="top-block">
		<h2><?=CHtml::encode($action->name)?></h2>
		<div class="oldPrice">вместо <span>1500</span></div>
		<a id="link-share" class="gray-button map" href="#"><i class="plus-gray"></i> Квартиры в закладках</a>
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
		<?=$action->long_desc?>
	</section>

	<section id="order"><?php $this->renderPartial('/catalog/_booking_form');?></section>
</section>
<div class="clear"></div>