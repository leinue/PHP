<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<title><?php bloginfo('name'); ?></title>
		<link href="http://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
	<div class="container-fluid">
	<div class="row">
		<nav class="navbar navbar-inverse nav-own">
  			<div class="container-fluid col-md-offset-1">
    		<!-- Brand and toggle get grouped for better mobile display -->
    			<div class="navbar-header">
      				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        				<span class="sr-only">Toggle navigation</span>
        				<span class="icon-bar"></span>
        				<span class="icon-bar"></span>
        				<span class="icon-bar"></span>
      				</button>
      				<a class="navbar-brand" href="<?php bloginfo('url'); ?>">
        				<img alt="Brand" width="20" height="20" src="http://localhost/wordpress/wp-content/themes/uniguy/brand.png">
      				</a>
    			</div>

    			<!-- Collect the nav links, forms, and other content for toggling -->
    			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      				<ul class="nav navbar-nav">
              <?php //wp_list_pages(); ?>
        				<li><a style="color: rgb(255,255,255);" href="<?php bloginfo('url'); ?>">首页 <span class="sr-only">(current)</span></a></li>
        				<li><a style="color: rgb(255,255,255);" href="#">服务</a></li>
        				<li><a style="color: rgb(255,255,255);" href="#">案例</a></li>
        				<li><a style="color: rgb(255,255,255);" href="#">新闻</a></li>
        				<li><a style="color: rgb(255,255,255);" href="#">技术支持</a></li>
        				<li><a style="color: rgb(255,255,255);" href="#">联系我们</a></li>
      				</ul>
      				<ul class="nav navbar-nav navbar-right">
      					<li><a href="#"><span class="glyphicon glyphicon-search menu-own" aria-hidden="true"></span></a></li>
      				</ul>
    			</div><!-- /.navbar-collapse -->
  			</div><!-- /.container-fluid -->
		</nav>