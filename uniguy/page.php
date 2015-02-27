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
		<!--<img class="service-background-img" src="http://localhost/wordpress/wp-content/themes/uniguy/service_bg.jpg">-->
		
			<div class="container-fluid">
				<div class="row">
					<div class="main-title">
						<img width="264" height="264" src="http://images.apple.com/v/osx/c/images/overview/hero_icon_large.png">
						<h1>我们的服务</h1>
						<h3>每一点凝聚的强大，处处尽现。</h3>
						<h5><p>优雅的设计带来令人耳目一新的感觉，与此同时，又会让人倍感亲切。</p><p>你日常所用的 app 增加了新的功能，而今愈加强大。</p><p>而你的 Mac 与 iOS 设备之间的关系也焕然一新，更进一步</p>。<p>OS X Yosemite 会让你以崭新的眼光来审视 Mac，以及你能和它携手成就的一切。</p><p>访问 Mac App Store 免费升级。</p></h5>
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
