
<section>
	<div class="gallery-content">
	<?php
		$serviceData=$ashu_option['service'];
	?>
		<img src="<?php echo $serviceData['service_bg']; ?>">
		<div style="margin-top:100px" class="gallery-heading page-service">
			<img src="<?php echo $serviceData['service_small_img']; ?>">
			<div class="page-heading-outline">
				<h1><?php echo $serviceData['service_big_title']; ?></h1>
				<h5><?php echo $serviceData['service_medium_title']; ?></h5>
			</div>	
			<div class="page-heading-detail">
				<p><?php echo $serviceData['service_small_title']; ?></p>
			</div>
		</div>
	</div>

	<!-- <div style="margin-top:100px" class="product-info">
		<div class="heading-product">
			<h2><?php echo $serviceData['propaganda1_big_title]']; ?></h2>
			<p class="product-subheading"><?php echo $serviceData['propaganda1_medium_title']; ?></p>
			<div class="product-detail">
				<p><?php echo $serviceData['propaganda1_small_desc']; ?></p>
				<a href="<?php echo $serviceData['propaganda1_small_href']; ?>"><?php echo $serviceData['propaganda1_small_href_title']; ?></a>
			</div>
		</div>
		<div class="design-hero-img">
			<img src="<?php echo $serviceData['propaganda1_small_img']; ?>">
		</div>
	</div>

	<div style="margin-top:100px" class="product-info">
		<div class="heading-product">
			<h2><?php echo $serviceData['propaganda2_big_title']; ?></h2>
			<p class="product-subheading"><?php echo $serviceData['propaganda2_medium_title']; ?></p>
			<div class="product-detail">
				<p><?php echo $serviceData['propaganda2_small_desc']; ?></p>
				<a href="<?php echo $serviceData['propaganda2_small_href']; ?>"><?php echo $serviceData['propaganda2_small_href_title']; ?></a>
			</div>
		</div>
		<div class="design-hero-img-big">
			<img class="tidy-img-responsive" src="<?php echo $serviceData['propaganda2_small_img']; ?>">
		</div>
	</div>

	<div style="margin-top:100px" class="product-info">
		<div class="heading-product">
			<h2><?php echo $serviceData['propaganda3_big_title']; ?></h2>
			<p class="product-subheading"><?php echo $serviceData['propaganda3_medium_title']; ?></p>
			<div class="product-detail">
				<p><?php echo $serviceData['propaganda3_small_desc']; ?></p>
				<a href="<?php echo $serviceData['propaganda3_small_href']; ?>"><?php echo $serviceData['propaganda3_small_href_title']; ?></a>
			</div>
		</div>
		<div class="design-hero-img">
			<img class="tidy-img-responsive" src="<?php echo $serviceData['propaganda3_small_img']; ?>">
		</div>
	</div> -->

	<div class="tidy-u-1 product-info-bg">
		<div class="heading-product">
			<h2><?php echo $serviceData['propaganda1_big_title']; ?></h2>
			<p class="product-subheading"><?php echo $serviceData['propaganda1_medium_title']; ?></p>
			<div class="product-detail">
				<p><?php echo $serviceData['propaganda1_small_desc']; ?></p>
				<a href="<?php echo $serviceData['propaganda1_small_href']; ?>"><?php echo $serviceData['propaganda1_small_href_title']; ?></a>
			</div>
		</div>
		<div class="tidy-u-1-3"></div>
		<div class="tidy-u-1-3" style="margin-top:20px;text-align-center">
			<img class="tidy-img-responsive" src="<?php echo $serviceData['propaganda1_small_img']; ?>">
		</div>
		<div class="tidy-u-1-3"></div>
	</div>

	<div class="tidy-u-1 product-info-bg">
		<div class="heading-product">
			<h2><?php echo $serviceData['propaganda2_big_title']; ?></h2>
			<p class="product-subheading"><?php echo $serviceData['propaganda2_medium_title']; ?></p>
			<div class="product-detail">
				<p><?php echo $serviceData['propaganda2_small_desc']; ?></p>
				<a href="<?php echo $serviceData['propaganda2_small_href']; ?>"><?php echo $serviceData['propaganda2_small_href_title']; ?></a>
			</div>
		</div>
		<div class="tidy-u-2-3" style="margin-top:20px;margin-bottom:-8px;">
			<img class="tidy-img-responsive" src="<?php echo $serviceData['propaganda2_small_img']; ?>">
		</div>
	</div>

	<div class="tidy-u-1 product-info-bg">
		<div class="heading-product">
			<h2><?php echo $serviceData['propaganda3_big_title']; ?></h2>
			<p class="product-subheading"><?php echo $serviceData['propaganda3_medium_title']; ?></p>
			<div class="product-detail">
				<p><?php echo $serviceData['propaganda3_small_desc']; ?></p>
				<a href="<?php echo $serviceData['propaganda3_small_href']; ?>"><?php echo $serviceData['propaganda3_small_href_title']; ?></a>
			</div>
		</div>
		<div class="tidy-u-1-3"></div>
		<div class="tidy-u-1-3" style="margin-top:20px;text-align-center">
			<img class="tidy-img-responsive" src="<?php echo $serviceData['propaganda3_small_img']; ?>">
		</div>
		<div class="tidy-u-1-3"></div>
	</div>

</section>

<script type="text/javascript">
	$(document).ready(function(){
		$('.gallery-heading').css('margin-top','0px');
		$('.product-info').css('margin-top','-20px');
	});
</script>
