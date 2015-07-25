<?php get_header(); ?>

<?php

$search_query =& new WP_Query("s=$s & showposts=-1");

?>

	<section style="margin-top:-100px" class="search-section">
		<div class="search_top">
			<div class="search_title">
				<h1>搜索</h1>
			</div>
			<div class="search_input">
				<input class="the_input" style="width:100%;" type="search" value="<?php echo $s; ?>" placeholder="请输入搜索内容,按回车进行搜索">
				<!-- <button class="btn" id="search_btn">搜索</button> -->
			</div>
			<div class="search_result">
				<div style="margin-top:100px;padding:5px;" class="post-block">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<ul id="post-<?php the_ID(); ?>" class="latest-post">
						<li class="post-detail">
							<div class="post-title"><a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a></div>
							<div class="post-content">
								<?php the_excerpt(); ?>
							</div>
							<div class="post-more">
								<ul>
									<!-- <li class="post-comment"><?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?></li> -->
									<li class="post-time"><?php the_author(); ?> 发表于 <?php the_time('Y年m月d日'); ?></li>
								</ul>
							</div>
						</li>
					</ul>
					<?php endwhile; else: ?>
					<p class="search_text">
				      <?php _e('您要搜索的内容不存在'); ?>
				    </p>
					<?php endif; ?>
					<ul class="pagation">
						<li><?php previous_posts_link('上一页'); ?></li>
						<li><?php next_posts_link('下一页'); ?></li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript">
		$(document).ready(function(){
			var docHeight=$(document).height();
			var headerHeight=$('header').height();
			var footerheight=$('footer').height();
			
			$('.search_top,section').css({
				'margin-top':'100px'
			});

			$('.post-block').css('margin-top','20px');

			$('.search_input input').keyup(function(e){
				if(e.which == 13){ 
					var input=$(this).val();
					if(input!=''){
						window.location.href="<?php bloginfo('home'); ?>/?s="+input+"&sa.x=0&sa.y=0";
					}else{
						alert('请输入搜索内容');
					}
				}
			});

			$('#search_btn').click(function(){
				
				$('.search_top').css({
					'margin-top':$('header').height()
				});
				
				var searchResultHeight=$('.search_result').height();
				if(searchResultHeight>docHeight-headerHeight-footerheight){
					$('footer').css({
						'position':'relative',
						'margin-top':''
					});
				}
			});
		});
	</script>

<?php get_footer(); ?>
