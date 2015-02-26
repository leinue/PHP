<?php get_header(); ?>

<?php the_title(); ?>

<?php if(have_posts()) : ?> 
<?php while(have_posts()) : the_post(); ?>

<div class="container-fluid">
	<div class="row">
		
  			<div class="container-fluid col-md-offset-2 col-md-8">
  				<div class="row">
  					<div class="service-menu">
  						<div class="sm-left">
  							<a href=""><?php the_title(); ?></a>
  						</div>
  						<div class="sm-right">
  							<ul>
  								<li>业务总览</li>
  								<li>我们的优势</li>
  								<li>精品案例</li>
  								<li>诸君的售后</li>
  							</ul>
  						</div>
  					</div>
  				</div>
  			</div>

  	</div>
</div>

<?php the_content(); ?>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
