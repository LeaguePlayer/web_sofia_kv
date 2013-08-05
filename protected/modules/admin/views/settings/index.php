<h1>Настройки</h1>
<?	
	$data = array();
	if($model->summary){
		$data = unserialize($model->summary);
	}
?>
<?php if(Yii::app()->user->hasFlash('success')):?>
	<div class="alert alert-success"><?php echo Yii::app()->user->getFlash('success'); ?></div>
<?php endif; ?>
<form action="" method="POST">
	<?=CHtml::activeHiddenField($model, 'id')?>
	<div class="form-group">
      	<label for="email">Email</label>
      	<input type="text" id="email" name="Settings[email]" class="form-control" value="<?=(isset($data['email']) ? $data['email'] : '')?>">
    </div>
    <div class="form-group">
      	<label for="phone_sms">Телефон для смс</label>
      	<input type="text" id="phone_sms" name="Settings[phone_sms]" class="form-control" value="<?=(isset($data['phone_sms']) ? $data['phone_sms'] : '')?>">
    </div>

	<div class="form-actions">
		<button type="submit" class="btn btn-default">Сохранить</button>
	</div>
</form>