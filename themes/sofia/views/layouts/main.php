<?php

$email = Settings::getEmail();

?>
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
		
		<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
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
					<a class="mail" href="mailto:<?= $email ?>"><?= $email ?></a>
					<span class="phone">
						<span class="simple"><small class="prefix">8 (3452) </small>500-333</span>
						<span class="info" style="margin-left: 44px;">основной (служба заказа)</span>
						<span class="simple"><span class="prefix">8-800-</span>500-3133</span>
						<span class="info" style="margin-left: 6px;">дополнительный (для регионов бесплатно)</span>
					</span>
					<a href="#fancy-form"  class="blue-button form static-button"><span>&nbsp;</span>Отправить заявку</a>

<? if((strpos(Yii::app()->request->requestUri, 'service') === FALSE) || (strpos(Yii::app()->request->requestUri, 'promo') === FALSE)):?>
					<a href="#fancy-form"  class="blue-button form float-button"><span>&nbsp;</span>Забронировать квартиру прямо сейчас</a>
<? endif; ?>
					<a href="#fancy-form-call"  class="blue-button form static-button call-button"><span>&nbsp;</span>Перезвонить мне</a>
				</div>
			</div>
		</header>
		<?php echo $content;?>
		<? if(($this->id != 'site') || ($this->getAction()->id != 'index')):?>
			<div class="bottom-back center"><a href="/" class="back" onclick="window.history.go(-1);return false;"><i>&#8666; </i>Назад</a></div>
		<? endif; ?>
		<footer class="center">
			<div class="copy">
				<span>София STYLE</span>
				<span class="grey">Все права защищены</span>
			</div>
			<div class="social">
<!--				<a class="link-vk" href="#"></a>-->
<!--				<a class="link-twitter" href="#"></a>-->
<!--				<a class="link-facebook" href="#"></a>-->
<!--				<a class="link-instagram" href="#"></a>-->
			</div>
			<div class="phone">
                <span class="simple"><small class="prefix">8 (3452) </small>500-333</span>
                <span class="info">основной (служба заказа)</span>
                <span class="simple"><span class="prefix">8-800-</span>500-3133</span>
                <span class="info">дополнительный (для регионов бесплатно)</span>
			</div>
            <div class="contacts">
                <p>Пишите нам: <a class="grey" href="mailto:<?= $email ?>"><?= $email ?></a></p>
            </div>
			<div class="clear"></div>
		</footer>
		<div id="fancy-form" style="display:none;"><?php $this->renderPartial('/catalog/_fancy_form');?></div>
		<div id="fancy-form-call" style="display:none;"><?php $this->renderPartial('/catalog/_fancy_form_call');?></div>
		<script type="text/javascript" src="<?=$this->getAssetsUrl()?>/js/common.js?v=5"></script>
		<?php
		Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/jquery.fancybox.pack.js', CClientScript::POS_HEAD );
		//Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/jquery.animate-shadow-min.js' ,CClientScript::POS_HEAD );
		Yii::app()->clientScript->registerCssFile($this->getAssetsUrl().'/css/fancybox/jquery.fancybox.css');
		?>
	</body>
</html>