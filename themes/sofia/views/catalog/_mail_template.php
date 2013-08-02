<table style="width: 700px">
	<?if(isset($model->id)){?>
	<?
		$room = Catalog::model()->findByPk($model->id);
	?>
	<tr>
		<td>Заявка на квартиру:</td>
		<td><?=CHtml::encode($room->address." кв. № ".$room->number)?></td>
	</tr>
	<?}?>
	<?if(isset($model->fio)){?>
	<tr>
		<td><?=$model->getAttributeLabel('fio')?> :</td>
		<td><?=CHtml::encode($model->fio)?></td>
	</tr>
	<?}?>
	<?if(isset($model->phone)){?>
	<tr>
		<td><?=$model->getAttributeLabel('phone')?> :</td>
		<td><?=CHtml::encode($model->phone)?></td>
	</tr>
	<?}?>
	<?if(isset($model->email)){?>
	<tr>
		<td><?=$model->getAttributeLabel('email')?> :</td>
		<td><?=CHtml::encode($model->email)?></td>
	</tr>
	<?}?>
	<?if(isset($model->price)){?>
	<tr>
		<td><?=$model->getAttributeLabel('price')?> :</td>
		<td><?=CHtml::encode($model->price)?></td>
	</tr>
	<?}?>
	<?if(isset($model->rooms_count)){?>
	<?
		if(is_array($model->rooms_count)){
			$rooms_count = array();
			foreach ($model->rooms_count as $key => $value) {
				if($value != 0) $rooms_count[] = $key;
			}
			$model->rooms_count = implode(',', $rooms_count);
		} 
	?>
	<tr>
		<td><?=$model->getAttributeLabel('rooms_count')?> :</td>
		<td><?=CHtml::encode($model->rooms_count)?></td>
	</tr>
	<?}?>
	<?if(isset($model->human_count)){?>
	<tr>
		<td><?=$model->getAttributeLabel('human_count')?> :</td>
		<td><?=CHtml::encode($model->human_count)?></td>
	</tr>
	<?}?>
	<?if(isset($model->days)){?>
	<tr>
		<td><?=$model->getAttributeLabel('days')?> :</td>
		<td><?=CHtml::encode($model->days)?></td>
	</tr>
	<?}?>
	<?if(isset($model->date)){?>
	<tr>
		<td><?=$model->getAttributeLabel('date')?> :</td>
		<td><?=CHtml::encode($model->date)?></td>
	</tr>
	<?}?>
	<?if(isset($model->message)){?>
	<tr>
		<td><?=$model->getAttributeLabel('message')?> :</td>
		<td><?=CHtml::encode($model->message)?></td>
	</tr>
	<?}?>
</table>