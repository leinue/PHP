<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	<script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
	<link rel="stylesheet" href="<?php echo get_bloginfo( 'stylesheet_directory' )?>/css/tidy.css">
	<script type="text/javascript" src="<?php echo get_bloginfo( 'stylesheet_directory' )?>/js/tidy.js"></script>
	<!-- <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>-->
	<!-- <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
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
					<li style="position:absolute;margin-top:-28px;" class="heading-menu heading-o heading-input"><input class="input-search" style="padding:0" id="top_input_search" type="search" placeholder="回车 搜索 uniguy.com"></li>
					<li class="heading-menu heading-toggle"><img id="list-toggle" src="<?php bloginfo('url'); ?>/wp-content/themes/uniguy2/imgs/toggle_list.png" width="20" height="20"></li>
				</ul>
			</div>
			<div style="" class="heading heading-bottom">
				<div style="width:100%;text-align:center" class="heading-list">
					<ul style="text-align:center" class="heading-small">
						<li style="text-align:center!important" class="heading-menu heading-o"><a href="<?php bloginfo('url'); ?>">首页</a></li>
						<?php wp_list_pages('title_li=&sort_column=post_date'); ?>
						<li style="text-align:center!important" class="heading-menu heading-o"><a href="<?php bloginfo('home'); ?>/?s=&sa.x=0&sa.y=0">搜索</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
</header>

<?php global $ashu_option; ?>

<script type="text/javascript">
	$('#top_input_search').keyup(function(e){
		if(e.which == 13){ 
			var input=$(this).val();
			if(input!=''){
				window.location.href="<?php bloginfo('home'); ?>/?s="+input+"&sa.x=0&sa.y=0";
			}else{
				alert('请输入搜索内容');
			}
		}
	});
</script>
