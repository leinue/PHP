
<?php get_header(); ?>

<?php

function get_post_thumbnail_url($post_id,$size='large'){
	$thumbnail_id = get_post_thumbnail_id($post_id);
	if($thumbnail_id ){
		$thumb = wp_get_attachment_image_src($thumbnail_id, $size);
		return $thumb[0];
	}else{
		return false;
	}
}

?>

<section>
	<div class="gallery-content" style="background: url('<?php bloginfo('url'); ?>/wp-content/themes/uniguy2/imgs/home.jpg');background-position: center center;">
		<div class="gallery-heading">
			<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('description'); ?></a></h1>
		</div>
	</div>

	<div class="tidy-g">
		<?php
			$myposts = get_posts('numberposts=10&orderby=post_date&order=DESC');

			$postCount=count($myposts);

			if($postCount>4){
				$postCount=4;
			}

			$current_url = home_url(add_query_arg(array(),$wp->request)); 

			for ($i=0; $i < $postCount; $i++) {
				// print_r($myposts[$i]);
				if($myposts[$i]->post_status=='publish'){
					$image = get_post_thumbnail_url($myposts[$i]->ID);
					echo "<div ref=\"".$myposts[$i]->guid."\" class=\"tidy-u-1-4\" style=\"min-height:200px;background: transparent url('$image') repeat scroll center center!important;\"><a href=\"".$myposts[$i]->guid."\"></a></div>";
				}
			}
		?>
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
