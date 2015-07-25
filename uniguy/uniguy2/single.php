<?php get_header(); ?>
	
	<section>
		<div style="margin-top:100px" class="content-panel">
			<div class="content-heading">
				<div class="heading-title"><?php the_title(); ?></div>
				<div class="img-desc">
					<span><a href="<?php echo get_option('home'); ?>">主页</a></span>&nbsp;/&nbsp;
					<span><?php edit_post_link('编辑', '', ''); ?></span>&nbsp;/&nbsp;
					<span>发表于：<span><?php the_time('Y年m月d日') ?></span></span>
					<!-- <span><?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?></span> -->
					<!-- <span><a href="#commentform">发表评论</a></span> -->
				</div>
			</div>
			<div class="content-detail">
				<P class="de-desc">
				<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
   				<?php else : ?>
				    <div class="errorbox">
				        没有文章！
				    </div>
			    <?php endif; ?>
			    <?php the_content(); ?></p>
			</div>
			<div class="content-tags">
				<ul class="tags">
					<?php the_tags('标签：', ', ', ''); ?>
				</ul>
			</div>

			<div class="ds-thread" data-thread-key="<?php the_title(); ?>" data-title="<?php the_title(); ?>" data-url="<?php the_permalink(); ?>"></div>
			<script type="text/javascript">
			var duoshuoQuery = {short_name:"uniguy-unity"};
				(function() {
					var ds = document.createElement('script');
					ds.type = 'text/javascript';ds.async = true;
					ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
					ds.charset = 'UTF-8';
					(document.getElementsByTagName('head')[0] 
					 || document.getElementsByTagName('body')[0]).appendChild(ds);
				})();
			</script>
		</div>

	</section>

<?php get_footer(); ?>
<script type="text/javascript">
	$('footer').hide();
	$(document).ready(function(){
		$('.content-panel').css('margin-top','0px');
	});
</script>