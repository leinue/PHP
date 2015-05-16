<?php require('header.php'); ?>

	<section>
		<div class="search_top">
			<div class="search_title">
				<h1>搜索</h1>
			</div>
			<div class="search_input">
				<input class="the_input" style="width:60%;" type="search" placeholder="请输入搜索内容">
				<a class="the_btn light_blue black_color no_radius" id="search_btn">搜索</a>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		$(document).ready(function(){
			$('body').css('background','#FAFAFA');
			$('footer').css({
				'position':'fixed',
				'bottom':'0',
				'width':'100%'
			});
			$('.search_top').css({
				'margin-top':($(document).height())/2-$('.search_top').height()-50
			});
		});
	</script>

<?php require('footer.php'); ?>