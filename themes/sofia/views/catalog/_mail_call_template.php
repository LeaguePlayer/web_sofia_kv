<table style="width: 700px">
	<tr>
		<td>Заказ звонка</td>
	</tr>
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
</table>