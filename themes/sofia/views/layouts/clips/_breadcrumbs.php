<section>
<?	$this->widget('zii.widgets.CBreadcrumbs', array(
  'separator'=>'',
  'links'=>$this->breadcrumbs,
  'tagName'=>'ul',
  'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
  'inactiveLinkTemplate'=>'<li class="last">{label}</li>', 
  'homeLink'=>'<li><a href="'.Yii::app()->homeUrl.'">Главная</a></li>',

  'htmlOptions'=>array('class'=>'breadcrumbs')
	)); 
?>
</section>