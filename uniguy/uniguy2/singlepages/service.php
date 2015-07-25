
<section>
	<div class="gallery-content">
	<?php
		$serviceData=$ashu_option['service'];
		$serviceDataAdded=$ashu_option['service-add'];
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

	<?php
		// echo "<script>alert('".$serviceData['service_pa_count']."')</script>";

		for ($i=1; $i <=$serviceData['service_pa_count']; $i++) {
			if($serviceData['checkbox_service_pa'.$i.'_visibile'][0]!=='0'){continue;}
			// echo "<script>alert('".$serviceData['checkbox_service_pa'.$i.'_visibile']['0']."')</script>";
			echo '<div class="tidy-u-1 product-info-bg">
					<div class="heading-product">
						<h2>'.$serviceData['propaganda'.$i.'_big_title'].'</h2>
						<p class="product-subheading">'.$serviceData['propaganda'.$i.'_medium_title'].'</p>
						<div class="product-detail">
							<p>'.$serviceData['propaganda'.$i.'_small_desc'].'</p>
							<a href="'.$serviceData['propaganda'.$i.'_small_href'].'">'.$serviceData['propaganda'.$i.'_small_href_title'].'</a>
						</div>
					</div>
					<div class="tidy-u-1-3"></div>
					<div class="tidy-u-1-3" style="margin-top:20px;text-align-center">
						<img class="tidy-img-responsive" src="'.$serviceData['propaganda'.$i.'_small_img'].'">
					</div>
					<div class="tidy-u-1-3"></div>
				</div>';
		}

		if($serviceDataAdded['service_add_pa_count']!=='0'){
			for ($i=$serviceData['service_pa_count']+1; $i <=$serviceDataAdded['service_add_pa_count']+$serviceData['service_pa_count']; $i++) { 
				echo '<div class="tidy-u-1 product-info-bg">
						<div class="heading-product">
							<h2>'.$serviceDataAdded['propaganda'.$i.'_big_title'].'</h2>
							<p class="product-subheading">'.$serviceDataAdded['propaganda'.$i.'_medium_title'].'</p>
							<div class="product-detail">
								<p>'.$serviceDataAdded['propaganda'.$i.'_small_desc'].'</p>
								<a href="'.$serviceDataAdded['propaganda'.$i.'_small_href'].'">'.$serviceDataAdded['propaganda'.$i.'_small_href_title'].'</a>
							</div>
						</div>
						<div class="tidy-u-1-3"></div>
						<div class="tidy-u-1-3" style="margin-top:20px;text-align-center">
							<img class="tidy-img-responsive" src="'.$serviceDataAdded['propaganda'.$i.'_small_img'].'">
						</div>
						<div class="tidy-u-1-3"></div>
					</div>';
			}
		}
	?>

</section>

<script type="text/javascript">
	$(document).ready(function(){
		$('.gallery-heading').css('margin-top','0px');
		$('.product-info').css('margin-top','-20px');
	});
</script>
