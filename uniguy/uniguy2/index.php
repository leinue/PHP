
<?php get_header(); ?>

<section>
	<div class="gallery-content" style="background: url('<?php bloginfo('url'); ?>/wp-content/themes/uniguy2/imgs/home.jpg');background-position: center center;">
		<div class="gallery-heading">
			<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('description'); ?></a></h1>
		</div>
	</div>

	<div class="promos">
		<ul class="news-mo">
		<?php
			$myposts = get_posts('numberposts=10&orderby=post_date&order=DESC');

			$postCount=count($myposts);

			if($postCount>4){
				$postCount=4;
			}

			$current_url = home_url(add_query_arg(array(),$wp->request)); 

			for ($i=0; $i < $postCount; $i++) { 
				// print_r($myposts[$postCount]);
				echo "<li ref=\"".$myposts[$i]->guid."\" style=\"background: transparent url('".$current_url."/wp-content/themes/uniguy2/imgs/promo".($i+1).".jpg') repeat scroll center center!important;\"><a href=\"".$myposts[$i]->guid."\"></a></li>";
			}
		?>
<!-- 			<li style="background: transparent url('<?php bloginfo('url'); ?>/wp-content/themes/uniguy2/imgs/promo_world_gallery_large.jpg') repeat scroll center center!important;"><a href=""></a></li>
			<li style="background: transparent url('<?php bloginfo('url'); ?>/wp-content/themes/uniguy2/imgs/promo_blog_large.jpg') repeat scroll center center!important;"><a href=""></a></li>
			<li style="background: transparent url('<?php bloginfo('url'); ?>/wp-content/themes/uniguy2/imgs/promo_changes_ipad_large.jpg') repeat scroll center center!important;"><a href=""></a></li>
			<li style="background: transparent url('<?php bloginfo('url'); ?>/wp-content/themes/uniguy2/imgs/promo_appletv_hbonow_large.jpg') repeat scroll center center!important;"><a href=""></a></li>
 -->		</ul>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function(){
		$('.promos .news-mo li').click(function(){
			window.location.href=$(this).attr('ref');
		});
	});
</script>

<?php get_footer(); ?>
