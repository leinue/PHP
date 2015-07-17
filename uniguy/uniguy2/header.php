<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	<script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
	<title><?php bloginfo('name'); ?></title>
</head>

<body>

<header>
	<nav>
		<div class="heading">
			<div class="heading-list">
				<ul class="heading-big">
					<li class="heading-menu heading-brand"><a href="<?php bloginfo('url'); ?>"><img id="brand" src="<?php bloginfo('url'); ?>/wp-content/themes/uniguy2/brand.png" width="20" height="20"></a></li>
					<li class="heading-menu heading-o"><a href="<?php bloginfo('url'); ?>">首页</a></li>
					<?php wp_list_pages('title_li=&sort_column=post_date'); ?>
					<li class="heading-menu heading-o"><a href="javascript:void('')"><img id="btn-search" src="<?php bloginfo('url'); ?>/wp-content/themes/uniguy2/imgs/search.png" width="20" height="20"></a></li>
					<li class="heading-menu heading-o heading-input"><input class="input-search" type="search" placeholder="搜索 uniguy.com"></li>
					<li class="heading-menu heading-toggle"><img id="list-toggle" src="<?php bloginfo('url'); ?>/wp-content/themes/uniguy2/imgs/toggle_list.png" width="20" height="20"></li>
				</ul>
			</div>
			<div class="heading heading-bottom">
				<div class="heading-list">
					<ul class="heading-small">
						<li class="heading-menu heading-o"><a href="<?php bloginfo('url'); ?>">首页</a></li>
						<?php wp_list_pages('title_li=&sort_column=post_date'); ?>
						<li class="heading-menu heading-o"><a href="">搜索</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
</header>

<?php global $ashu_option; ?>
