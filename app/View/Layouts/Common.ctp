<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
	<meta http-equiv="expires" content="0">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<meta http-equiv="Content-Script-Type" content="text/javascript">
	<meta name="copyright" content="Copyright tabimap">
	
	<meta name="description" content="あなたが行った国を友達と共有">
	<meta name="keywords" content="旅,地図,海外">
	
	<link rel="shortcut icon" href="<?=$this->Html->webroot.'img/favicon.ico'?>">
	<link rel="apple-touch-icon-precomposed" href="<?=$this->Html->webroot.'img/favicon.ico'?>" />
	
	<title><?=$title_for_layout?> - Tabimap</title>
		
	<?=$this->Html->css('remodal')?>
	<?=$this->Html->css('common')?>
	
	<?php
	if($is_mobile) {
		echo $this->Html->css('mobile').'<meta name="viewport" content="width=320, initial-scale=1.0">';
	} else {
		echo $this->Html->css('default');
	}
	?>
</head>
<body>
<?php if(!$this->Class->checkControllerAndAction('users','create')) :?>
<div class="header">
	<div class="container">
		<h1 class="header_title"><a href="/"><i class="icon-logo"></i><span>βver</span></a></h1>
		<ul class="header_menu">
			<li><a href="/home" <?=$this->Class->addClassByControllerAndAction('friends','index')?>><i class="icon-earth"></i>すべての友達</a></li>
			<li><a href="/areas" <?=$this->Class->addClassByController('areas')?>><i class="icon-search"></i>すべての国</a></li>
			<li><a href="/users" <?=$this->Class->addClassByControllerAndAction('users','index')?>><i class="icon-map"></i>マイページ</a></li>
		</ul>
	</div>
</div>
<?php endif?>
<?=$this->fetch('content'); ?>
<div class="footer">
	<div class="container">
		<ul class="footer_menu">
			<li><blockquote>We <3 the world.</blockquote></li>
			<li><a href="/help" <?=$this->Class->addClassByControllerAndAction('pages','help')?>>ヘルプ</a></li>
			<li><a href="/terms" <?=$this->Class->addClassByControllerAndAction('pages','terms')?>>利用規約</a></li>
			<li><a href="/policy" <?=$this->Class->addClassByControllerAndAction('pages','policy')?>>プライバシーポリシー</a></li>
			<li>©2014 Tabimap&nbsp;created by <a target="_blank" href="https://twitter.com/ya_s_u">@ya_s_u</a> in Japan</li>
		</ul>
	</div>
</div>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
<?=$this->html->script('//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js')?>
<?=$this->html->script('jquery.remodal.min')?>
<?=$this->html->script('jquery.color')?>
<?=$this->html->script('jquery.vmap')?>
<?=$this->html->script('world-ja')?>
<?=$this->html->script('main')?>
<?php
if(getenv('HEROKU_APP_ENVIRONMENT') == 'production') {
	echo "<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54341699-1', 'auto');
  ga('send', 'pageview');

</script>";
}
?>
</body>
</html>