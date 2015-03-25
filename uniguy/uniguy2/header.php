<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	<title><?php bloginfo('name'); ?></title>
</head>

<body>

<header>
	<nav>
		<div class="heading">
			<div class="heading-list">
				<ul class="heading-big">
					<li class="heading-menu heading-brand"><a href="<?php bloginfo('url'); ?>"><img id="brand" src="http://localhost/wordpress/wp-content/themes/uniguy2/brand.png" width="20" height="20"></a></li>
					<li class="heading-menu heading-o"><a href="<?php bloginfo('url'); ?>">首页</a></li>
					<?php wp_list_pages('title_li=&sort_column=post_date'); ?>
					<li class="heading-menu heading-o"><a href="javascript:void('')"><img id="btn-search" src="http://localhost/wordpress/wp-content/themes/uniguy2/imgs/search.png" width="20" height="20"></a></li>
					<li class="heading-menu heading-o"><input class="input-search" type="search" placeholder="搜索 uniguy.com"></li>
					<li class="heading-menu heading-toggle"><img id="list-toggle" src="http://localhost/wordpress/wp-content/themes/uniguy2/imgs/toggle_list.png" width="20" height="20"></li>
				</ul>
			</div>
			<div class="heading heading-bottom">
				<div class="heading-list">
					<ul>
						<li class="heading-menu heading-o"><a href="<?php bloginfo('url'); ?>">首页</a></li>
						<?php wp_list_pages('title_li=&sort_column=post_date'); ?>
						<li class="heading-menu heading-o"><a href="">搜索</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
</header>