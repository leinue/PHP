<?php get_header(); ?>
		
		<section>

		<div class="carousel">
			<div class="container-fluid">
				<div class="row">
					<div class="main-title">
						<a href="#"><h1><?php bloginfo('description'); ?></h1></a>
					</div>
				</div>
			</div>
		</div>
	
		<div class="container-fluid">
			<div class="row">
				<div class="news-display">
					<?php $i=0;if(have_posts()): ?><?php while(have_posts()):

						if($i<4){
							the_post();
						?>
						<div class="col-md-3 news-block">
							<div class="news-block-title">
								<h4 class="text-muted"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
								<strong><h5 class="text-muted">点击查看新闻</h5></strong>
							</div>
							<div class="news-block-img">
								<img src="http://images.apple.com/cn/home/images/promo_iphone6_medium.jpg">
							</div>
							<?php //edit_post_link('Edit'); ?> 
						</div>

						<?php
						}else{
							break;
						}
						?>
						
					<?php $i=$i+1; ?>
					<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>

		</section>

<?php get_footer(); ?>
