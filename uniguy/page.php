<?php get_header(); ?>

<div class="container-fluid">
	<div class="row">
				
	<?php
		global $wp;
		$current_url=add_query_arg($wp->query_string,'',home_url($wp->request));
		$currentPageID=explode("?page_id=",$current_url);
		if($currentPageID[1]=='2'){
			echo file_get_contents("wp-content/themes/uniguy/service.php");
		}elseif($currentPageID[1]=='13'){
			echo file_get_contents("wp-content/themes/uniguy/case.php");
		}
	?>

	<?php //if(have_posts()) : ?> 
<?php //while(have_posts()) : the_post(); ?>


  	</div>
</div>

<?php //the_content(); ?>

<?php //endwhile; ?>
<?php //endif; ?>

<?php get_footer(); ?>

    <script>
  	  
		$(document).ready(function(){

			$('.explore-search').on('click',function(){
				$('.case-search-form').slideToggle('normal',function(){
					$('.case-second-menu').toggleClass('case-second-menu-border');
				});
				
			});
			
		});
	</script>