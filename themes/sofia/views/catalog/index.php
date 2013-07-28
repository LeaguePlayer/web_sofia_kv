<section class="left">
	<?php $this->renderPartial('/catalog/_filter', array('model' => $model, 'areas' => $areas));?>
	<a id="link-share" class="gray-button" href="#"><i class="plus-blue"></i> Квартиры в закладках</a>
	&nbsp;
</section>
<section id="catalog" class="right">
	<div class="rooms-count">
			<label class="text-title">смотреть только:</label>
			<a class="room1 <?=((isset($model->rooms_count[1]) && $model->rooms_count[1] != 0) ? "active" : "")?>" href="#">1 комнатные</a>
			<a class="room2 <?=((isset($model->rooms_count[2]) && $model->rooms_count[2] != 0) ? "active" : "")?>" href="#">2х комнатные</a>
			<a class="room3 <?=((isset($model->rooms_count[3]) && $model->rooms_count[3] != 0) ? "active" : "")?>" href="#">3х комнатные</a>
	</div>
	<?php
	$this->widget('zii.widgets.CListView', array(
	    'dataProvider'=>$data,
	    'itemView'=>'/catalog/_view',
	    'template'=>'{items}',
	    'cssFile'=>false,
	    'id'=>'catalog-list',
	    'emptyText'=>'<div class="nothing">Ничего не найдено.</div>'
	));
	?>
	<div class="clear"></div>
	<section id="order"><?php $this->renderPartial('/catalog/_booking_form');?></section>
</section>
<div class="clear"></div>

<?php
Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/catalog.js',  CClientScript::POS_END);
?>