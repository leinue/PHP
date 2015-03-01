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
						<h5><p>优雅的设计带来令人耳目一新的感觉，与此同时，又会让人倍感亲切。</p><p>你日常所用的 app 增加了新的功能，而今愈加强大。</p><p>而你的 Mac 与 iOS 设备之间的关系也焕然一新，更进一步</p><p>OS X Yosemite 会让你以崭新的眼光来审视 Mac，以及你能和它携手成就的一切。</p><p>访问 Mac App Store 免费升级。</p></h5>
					</div>
				</div>
			</div>

		</div>

		<div class="container-fluid">
  			<div class="row">
				<div class="col-xs-14">

					<div class="section-content">
						<div class="col-md-6 col-md-offset-3">

							<div class="section-content-headline">
								<h2>
								全新设计的界面
									<span class="subheadline">焕然一新,全新诸君</span>
								</h2>
							</div>

							<p>我们推出 OS X Yosemite 旨在提升 Mac 的使用体验。

为此，我们着眼于整个系统，对每个 app，每个功能，乃至每个像素逐一进行了完善。同时，我们将卓越的新功能构建于界面之中，让你所需的重要信息尽在指尖。如此一来，你的 Mac 有了焕然一新的外观，并依然拥有你所熟悉和喜爱的强大功能与简洁直观。<a href="" class="more">了解更多</a></p>
							
						</div>
						<div class="design-hero-img"></div>
					</div>

					<div class="section-content">
						<div class="col-md-6 col-md-offset-3">

							<div class="section-content-headline">
								<h2>
								全新设计的界面
									<span class="subheadline">焕然一新,全新诸君</span>
								</h2>
							</div>

							<p>单独使用 Mac 或 iOS 设备，你已能够成就非凡之事。而将二者配合使用，你将成就更多非凡。因为，现在 OS X 和 iOS 8 所拥有的众多全新精彩功能，既让人感到妙不可言，又让人觉得理所当然。无需拿起 iPhone，便可接打电话。在一部设备上开始撰写电子邮件、编辑文件或浏览网页，然后转到另一部设备上继续进行。甚至，你还能无需从口袋或背包取出 iPhone，即可启用 iPhone 热点*。<a href="" class="more">了解更多</a></p>
							
						</div>
						<div class="col-md-10">
							<div class="continuity-image"></div>
						</div>
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
