<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8" />
		<title>Главная | Sofia style</title>

		<script type="text/javascript" src="<?=$this->themeUrl?>/js/modernizr.custom.js"></script>
		<? /*<script type="text/javascript" src="<?=$this->themeUrl?>/js/jQuery_1.9.1.js"></script>*/?>
		<script type="text/javascript" src="<?=$this->themeUrl?>/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script type="text/javascript" src="<?=$this->themeUrl?>/js/chosen.jquery.min.js"></script>
	</head>
	<body <?php $this->is_home() ? print 'class="background"' : print '';?>>
		<header id="main">
			<div class="center">
				<div class="logo">
					<h1><a href="/">Home hotel</a></h1>
					<a href="/"><img src="<?=$this->themeUrl?>/images/logo.png"></a>
				</div>
				<div class="contacts">
					<a class="mail" href="mailto:info@sofiastyle.ru">info@sofiastyle.ru</a>
					<span class="phone">8 912 922 555</span>
					<a href="#send" class="blue-button"><span>&nbsp;</span>Отправить заявку</a>
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
				<a class="link-vk" href="#"></a>
				<a class="link-twitter" href="#"></a>
				<a class="link-facebook" href="#"></a>
				<a class="link-instagram" href="#"></a>
			</div>
			<div class="phone">
				<span>8 912 922 555</span>
				<a class="grey" href="mailto:info@sofiastyle.ru">info@sofiastyle.ru</a>
			</div>
			<div class="clear"></div>
		</footer>
		<script type="text/javascript" src="<?=$this->themeUrl?>/js/common.js"></script>
	</body>
</html>