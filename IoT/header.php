<?php
//require('config.php');

function echoActive($title,$now){
	$mainTitle=explode(" - ",$title);
	if($mainTitle[0]==$now){
		echo 'class="title-active"';
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<link rel="stylesheet" href="css/style.css" />
	<script>document.write(unescape('%3Cscript%20type%3D%22text/javascript%22%20src%3D%22http%3A//api.map.baidu.com/api%3Fv%3D2.0%26ak%3D52E434d922f90a508da65f332d406553%22%3E%3C/script%3E'));</script>
	<title><?php echo $title; ?></title>
</head>
<body>
	<div class="big-title"><h3>“醉翁禁驾”——基于物联网的远程酒驾监控系统</h3></div>
	<div class="content-head">
		<ul class="main-title">
			<li id="service-title"><a href="index.php"><img width="20" height="20" src="img/logo.png"></a></li>
			<li <?php echoActive($title,"首页"); ?> ><a href="index.php">首页</a></li>
			<li id="getCurrentPos"><a href="">位置查询</a></li>
			<li id="ajaxlocate"><a href="">天眼监控</a></li>
			<li id="submitLongAndLat"><a href="">汽车防盗</a></li>
			<li><a href="">交通服务</a></li>
			<li <?php echoActive($title,"关于我们"); ?> id="about"><a href="about.php">关于我们</a></li>
			<li <?php echoActive($title,"联系我们"); ?> id="contact"><a href="contact.php">联系我们</a></li>
		</ul>
	</div>