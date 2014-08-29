<?php $this->beginClip('main_menu'); ?>
<nav id="main-menu">
<?php 

$action_link = array();
if($this->action) $action_link = array('label'=>'Спецальные предложения', 'url'=>array('/promo/view', 'id' => $this->action->id));

$this->widget('zii.widgets.CMenu',array(
	'items'=>array(
		array('label'=>'Каталог квартир', 'url'=>array('/catalog/index')),
		array('label'=>'Просмотр на карте', 'url'=>array('/catalog/map')),
		$action_link,
		array('label'=>'Дополнительные услуги', 'url'=>array('/service/'), 'active'=> (strpos($this->getId(), 'service') !== false)),
		array('label'=>'Контакты', 'url'=>array('/page/contacts'), 'active'=> (strpos($this->getId(), 'page') !== false))
	),
)); ?>
</nav>

<section class="crumbs">
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

	<a href="/" class="back"><i>← </i>Вернуться на главную</a>

</section>

<?php $this->endClip(); ?>
