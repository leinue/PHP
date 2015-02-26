<?php get_header(); ?>

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
  								<li><a href="">业务总览</a></li>
  								<li><a href="">我们的优势</a></li>
  								<li><a href="">精品案例</a></li>
  								<li class="sm-right-li-last"><a href="">诸君的售后</a></li>
  							</ul>
  						</div>
  					</div>
  				</div>
  			</div>


		<div class="carousel-service">
			<div class="container-fluid">
				<div class="row">
					<div class="main-title">
						<a href="#"><h1>fddfddf</h1></a>
					</div>
				</div>
			</div>
		</div>

	<?php if(have_posts()) : ?> 
<?php while(have_posts()) : the_post(); ?>


  	</div>
</div>

<?php the_content(); ?>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
