<?php $this->beginClip('main_menu'); ?>
<nav id="main-menu">
<?php 

$action_link = array();
if($this->action) $action_link = array('label'=>'Специальные предложения', 'url'=>array('/promo/view', 'id' => $this->action->id));

$this->widget('zii.widgets.CMenu',array(
	'items'=>array(
		array('label'=>'Каталог квартир', 'url'=>array('/catalog/index')),
		array('label'=>'Квартиры на карте', 'url'=>array('/catalog/map')),
		$action_link,
		array('label'=>'Дополнительные услуги', 'url'=>array('/service/'), 'active'=> (strpos($this->getId(), 'service') !== false)),
		array('label'=>'Условия проживания', 'url'=>array('/page/terms'), 'active'=> false),
		array('label'=>'Арендуем квартиры', 'url'=>array('/page/rental'), 'active'=> false),
		array('label'=>'Отзывы', 'url'=>array('/page/reviews'), 'active'=> false),
		array('label'=>'Контакты', 'url'=>array('/page/contacts'), 'active'=> false),
	),
)); ?>
</nav>

<section class="crumbs">
	<? if(($this->id != 'site') || ($this->getAction()->id != 'index')):?>
		<a href="/" class="back" onclick="window.history.go(-1);return false;"><i>&#8666; </i>Назад</a>
	<? endif ;?>

	<?	$this->widget('zii.widgets.CBreadcrumbs', array(
	  'separator'=>'',
	  'links'=>$this->breadcrumbs,
	  'tagName'=>'ul',
	  'activeLinkTemplate'=>' <li><a href="{url}">{label}</a> /</li>',
	  'inactiveLinkTemplate'=>' <li class="last">{label}</li>', 
	  'homeLink'=>'<li><a href="'.Yii::app()->homeUrl.'">Главная</a> / </li>',

	  'htmlOptions'=>array('class'=>'breadcrumbs')
		)); 
	?>	
</section>

<?php $this->endClip(); ?>
