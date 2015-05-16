<?php  require('header.php'); ?>

	<section>
		<div class="introduction-home">
			<div style="background:url(images/1.jpg) repeat fixed center center / cover transparent;" class="cg"></div>
			<div class="illustration">
				<span>Features</span>
				<span>与众不同最时尚</span>
			</div>
		</div>
		<div id="product-1" class="product-info">
			<div class="heading-product">
				<h2>蛤蛤蛤蛤</h2>
				<p class="product-subheading">蛤蛤蛤蛤,蛤蛤蛤蛤</p>
				<div class="product-detail">
					<p>蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤</p>
					<a href="">了解更多 ></a>
				</div>
			</div>
			<div class="design-hero-img">
				<img src="http://images.apple.com/cn/osx/overview/images/design_large.png">
			</div>
		</div>

		<div id="product-2" class="product-info">
			<div class="heading-product">
				<h2>蛤蛤蛤蛤</h2>
				<p class="product-subheading">蛤蛤蛤蛤,蛤蛤蛤蛤</p>
				<div class="product-detail">
					<p>蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤。</p>
					<a href="">了解更多 ></a>
				</div>
			</div>
			<div class="design-hero-img-big">
				<img src="http://images.apple.com/cn/osx/overview/images/mac_ios_large.png">
			</div>
		</div>

		<div id="product-3" class="product-info">
			<div class="heading-product">
				<h2>蛤蛤蛤蛤</h2>
				<p class="product-subheading">蛤蛤蛤蛤,蛤蛤蛤蛤</p>
				<div class="product-detail">
					<p>蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤</p>
					<a href="">了解更多 ></a>
				</div>
			</div>
			<div class="design-hero-img">
				<img src="http://images.apple.com/cn/osx/overview/images/apps_large.png">
			</div>
		</div>

	</section>

<script type="text/javascript">
	$('.introduction-home .cg').css('padding-top',$(document).height()-2200);
	
	$(window).scroll(function(){

		if($(document).scrollTop()>$('.introduction-home').height()-600){
			$('#product-1').css('opacity','1');
		}else{
			$('#product-1').css('opacity','0');
		}

		if($(document).scrollTop()>$('#product-1').height()+$('.introduction-home').height()-400){
			$('#product-2').css('opacity','1');
		}else{
			$('#product-2').css('opacity','0');
		}

		if($(document).scrollTop()>$('#product-1').height()+$('.introduction-home').height()+$('#product-2').height()-400){
			$('#product-3').css('opacity','1');
		}else{
			$('#product-3').css('opacity','0');
		}

	});
</script>

<?php  require('footer.php'); ?>