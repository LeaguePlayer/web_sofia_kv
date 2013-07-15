<?php $this->beginClip('main_menu'); ?>
<nav id="main-menu">
<?php $this->widget('zii.widgets.CMenu',array(
	'items'=>array(
		array('label'=>'Каталог квартир', 'url'=>array('/catalog/index')),
		array('label'=>'Просмотр на карте', 'url'=>array('/site/page')),
		array('label'=>'Спец.предложения', 'url'=>array('/site/contact')),
		array('label'=>'Дополнительные услуги', 'url'=>array('/site/login')),
		array('label'=>'Контакты', 'url'=>array('/site/logout'))
	),
)); ?>
</nav>
<?php $this->endClip(); ?>