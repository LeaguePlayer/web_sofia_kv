<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8" />
		<title><?=$this->pageTitle?> | Sofia style</title>

		<script type="text/javascript" src="<?=$this->getAssetsUrl()?>/js/modernizr.custom.js"></script>
		<? /*<script type="text/javascript" src="<?=$this->getAssetsUrl()?>/js/jQuery_1.9.1.js"></script>*/?>
		<script type="text/javascript" src="<?=$this->getAssetsUrl()?>/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script type="text/javascript" src="<?=$this->getAssetsUrl()?>/js/chosen.jquery.min.js"></script>
		<script type="text/javascript" src="http://vk.com/js/api/share.js?90" charset="windows-1251"></script>
	</head>
	<body <?php $this->is_home() ? print 'class="background"' : print '';?>>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&appId=1452373225031498&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
		<header id="main">
			<div class="center">
				<div class="logo">
					<h1><a href="/">Home hotel</a></h1>
					<a href="/"><img src="<?=$this->getAssetsUrl()?>/images/logo.png"></a>
				</div>
				<div class="contacts">
					<a class="mail" href="mailto:info@sofiastyle.ru"><?=Settings::getEmail()?></a>
					<span class="phone">
						<span class="simple">500-333</span>
						<span class="simple">8-800-500-3133</span>
						<span class="info">для регионов бесплатно</span>
					</span>
					<a href="#fancy-form"  class="blue-button form"><span>&nbsp;</span>Отправить заявку</a>
				</div>
			</div>
		</header>
		<?php echo $content;?>
		<footer class="center">
			<div class="copy">
				<span>СофияSTYLE</span>
				<span class="grey">Все права защищены</span>
			</div>
			<div class="social">
<!--				<a class="link-vk" href="#"></a>-->
<!--				<a class="link-twitter" href="#"></a>-->
<!--				<a class="link-facebook" href="#"></a>-->
<!--				<a class="link-instagram" href="#"></a>-->
			</div>
			<div class="phone">
				<span class="simple">500-333</span>
				<span class="simple">8-800-500-3133</span>
				<span class="info">для регионов бесплатно</span>
				<a class="grey" href="mailto:info@sofiastyle.ru"><?=Settings::getEmail()?></a>
			</div>
			<div class="clear"></div>
		</footer>
		<div id="fancy-form" style="display:none;"><?php $this->renderPartial('/catalog/_fancy_form');?></div>
		<script type="text/javascript" src="<?=$this->getAssetsUrl()?>/js/common.js?v=2"></script>
		<?php
		Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/jquery.fancybox.pack.js', CClientScript::POS_HEAD );
		//Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/jquery.animate-shadow-min.js' ,CClientScript::POS_HEAD );
		Yii::app()->clientScript->registerCssFile($this->getAssetsUrl().'/css/fancybox/jquery.fancybox.css');
		?>
	</body>
</html>