
<section>
	<div class="news-block">
		<ul>
		<?php 
        foreach(get_all_category_ids() as $v){
            $cat_info=get_category($v);
            if($cat_info->parent!='0'){
            	$parent_info=get_category($cat_info->parent);
            	if($parent_info->name=='news'){
            		echo "<li>
						<a href=\"\"><img src=\"$cat_info->description\"></a>
						<span class=\"help-block\"><a href=\"\">$cat_info->name</a></span>
					</li>";
            	}
            }
        } 
		?>
		</ul>
	</div>

	<div class="post-block">

	<?php
		$previous_year = $year = 0;
		$previous_month = $month = 0;
		$ul_open = false;

		$myposts = get_posts('numberposts=10&orderby=post_date&order=DESC');
	?>

	<?php foreach($myposts as $post) : ?>

	<?php
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
							<li class="post-comment"><?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?></li>
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
	</div>
</section>
