<div class="span3">
	<div class="thumbnail">
		<h3><?php echo CHtml::link(CHtml::encode($data->address),array('view','id'=>$data->id)); ?></h3>

		<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
		<?php echo CHtml::encode($data->address); ?>
		<br />
<?/*
		<b><?php echo CHtml::encode($data->getAttributeLabel('number')); ?>:</b>
		<?php echo CHtml::encode($data->number); ?>
		<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('desc')); ?>:</b>
		<?php echo CHtml::encode($data->desc); ?>
		<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('features')); ?>:</b>
		<?php echo CHtml::encode($data->features); ?>
		<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('price_24')); ?>:</b>
		<?php echo CHtml::encode($data->price_24); ?>
		<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('price_night')); ?>:</b>
		<?php echo CHtml::encode($data->price_night); ?>
		<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('price_hour')); ?>:</b>
		<?php echo CHtml::encode($data->price_hour); ?>
		<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
		<?php echo CHtml::encode($data->active); ?>
		<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('area')); ?>:</b>
		<?php echo CHtml::encode($data->cat_area->name); ?>
		<br />
*/?>
	</div>
</div>