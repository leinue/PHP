
<section>
	<div class="gallery-content">
	<?php
		$serviceData=$ashu_option['service'];
	?>
		<img src="<?php echo $serviceData['service_bg']; ?>">
		<div class="gallery-heading page-service">
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

	<div class="product-info">
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

	<div class="product-info">
		<div class="heading-product">
			<h2><?php echo $serviceData['propaganda2_big_title']; ?></h2>
			<p class="product-subheading"><?php echo $serviceData['propaganda2_medium_title']; ?></p>
			<div class="product-detail">
				<p><?php echo $serviceData['propaganda2_small_desc']; ?></p>
				<a href="<?php echo $serviceData['propaganda2_small_href']; ?>"><?php echo $serviceData['propaganda2_small_href_title']; ?></a>
			</div>
		</div>
		<div class="design-hero-img-big">
			<img src="<?php echo $serviceData['propaganda2_small_img']; ?>">
		</div>
	</div>

	<div class="product-info">
		<div class="heading-product">
			<h2><?php echo $serviceData['propaganda2_big_title']; ?></h2>
			<p class="product-subheading"><?php echo $serviceData['propaganda2_medium_title']; ?></p>
			<div class="product-detail">
				<p><?php echo $serviceData['propaganda2_small_desc']; ?></p>
				<a href="<?php echo $serviceData['propaganda2_small_href']; ?>"><?php echo $serviceData['propaganda2_small_href_title']; ?></a>
			</div>
		</div>
		<div class="design-hero-img">
			<img src="<?php echo $serviceData['propaganda2_small_img']; ?>">
		</div>
	</div>

</section>

