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
<?php $this->endClip(); ?>