<?php get_header(); ?>

<div style="margin-top:100px;padding:10px!important;" class="post-block" id="catagory-post-block">

	<?php
		$previous_year = $year = 0;
		$previous_month = $month = 0;
		$ul_open = false;

		$current_url=add_query_arg($wp->query_string,'',home_url($wp->request));
		$current_url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
		$cateid=explode("?", $current_url);
		$flag=-1;
		$myposts = get_posts('numberposts=10&orderby=&category='.$cateid[1].'post_date&order=DESC');


	?>

	<?php foreach($myposts as $post) : ?>

	<?php

		$flag+=1;

		setup_postdata($post);
		$year = mysql2date('Y', $post->post_date);
		$month = mysql2date('n', $post->post_date);
		$day = mysql2date('j', $post->post_date);
	?>

	<?php if($year != $previous_year || $month != $previous_month) : ?>

	<?php if($ul_open == true) : ?>
	<?php endif; ?>
	<?php $ul_open = true; ?>
	<?php endif; ?>
	<?php $previous_year = $year; $previous_month = $month; ?>

			<ul class="latest-post">
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
							<li class="post-time">wo 发表于 <?php the_time('Y年m月d日'); ?></li>
						</ul>
					</div>
				</li>
			</ul>

	<?php endforeach; ?>
		
		<ul class="pagation">
			<li><?php previous_posts_link('上一页'); ?></li>
			<li><?php next_posts_link('下一页'); ?></li>
		</ul>

	<?php
		if($flag<0){
			echo '<div style="width:100%;text-align:center;"><h2>暂无文章</h2></div>';
		}
	?>
</div>

<?php get_footer(); ?>

<?php

if($flag<0){
	echo "
				<script>
					$('footer').css('position','absolute').css('bottom','0');
				</script>
			";
}

?>