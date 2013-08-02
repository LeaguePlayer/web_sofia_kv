<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo CHtml::encode(Yii::app()->name).' | Admin';?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

  <body>

    <?php $this->widget('bootstrap.widgets.TbNavbar', array(
	    'type'=>'inverse', // null or 'inverse'
	    'brand'=> CHtml::encode(Yii::app()->name),
	    'brandUrl'=>'#',
	    'fluid' => true,
	    'collapse'=>true, // requires bootstrap-responsive.css
	    'items'=>array(
	        array(
	            'class'=>'bootstrap.widgets.TbMenu',
	            'items'=>array(
	                array('label'=>'Каталог', 'url'=>'/admin/catalog', 'active'=> (strpos($this->getId(), 'catalog') !== false), 'items' => array(
	                	array('label'=>'Создать', 'url'=>'/admin/catalog/create'),
	                    array('label'=>'Управление', 'url'=>'/admin/catalog/admin'),
	                )),
	                array('label'=>'Акции', 'url'=>'/admin/action', 'active'=> (strpos($this->getId(), 'action') !== false), 'items' => array(
	                	array('label'=>'Создать', 'url'=>'/admin/action/create'),
	                    array('label'=>'Управление', 'url'=>'/admin/action/admin'),
	                )),
	                array('label'=>'Районы', 'url'=>'/admin/area', 'active'=> (strpos($this->getId(), 'area') !== false), 'items' => array(
	                    array('label'=>'Управление', 'url'=>'/admin/area/'),
	                )),
	                array('label'=>'Промоблок на главной', 'url'=>'/admin/mainBlock', 'active'=> (strpos($this->getId(), 'mainBlock') !== false), 'items' => array(
	                    array('label'=>'Управление', 'url'=>'/admin/mainBlock/'),
	                )),
	                array('label'=>'Страницы', 'url'=>'/admin/page', 'active'=> (strpos($this->getId(), 'page') !== false), 'items' => array(
	                    array('label'=>'Управление', 'url'=>'/admin/page/admin'),
	                )),
	                array('label'=>'Отдых', 'url'=>'/admin/service', 'active'=> (strpos($this->getId(), 'service') !== false), 'items' => array(
	                    array('label'=>'Управление', 'url'=>'/admin/service/admin'),
	                )),
	                array('label'=>'Настройки', 'url'=>'/admin/settings', 'active'=> (strpos($this->getId(), 'settings') !== false), 'items' => array(
	                    array('label'=>'Управление', 'url'=>'/admin/settings/index'),
	                )),
	            ),
	        ),
	        array(
	            'class'=>'bootstrap.widgets.TbMenu',
	            'htmlOptions'=>array('class'=>'pull-right'),
	            'items'=>array(
	                array('label'=>'Выйти', 'url'=>'/admin/user/logout'),
	            ),
	        ),
	    ),
	)); ?>

    <div class="container-fluid">
		<div class="row-fluid">
	    	<div class="span1">
	      	<?php $this->widget('bootstrap.widgets.TbMenu', array(
			    'type'=>'list',
			    'items'=> $this->menu
			    )); ?>
	    	</div>
	    	<div class="span11">
	      		<?php echo $content;?>
	    	</div>
	  	</div>
	</div>
    

  </body>
</html>
