<?php require('header.php') ?>

<section>
	<div class="top_content">
		<div class="dy_display">
			<ul>
				<li>
					<div class="floating_box">
						sdsds
					</div>
				</li>
				<li>
					<div class="dy_content">
						<div class="dy_img_info">
							<div class="dy_title">
								<h2>蛤蛤蛤蛤谈笑风生</h2>
								<div class="dy_date">
									<span>2015年5月8日 00:00</span>
								</div>
							</div>
							<div class="dy_description">
								
							</div>
							<div style="width:100%" class="dy_tags">
								<ul>
									<li><a class="normal_a" href="">tag1</a></li>
									<li><a class="normal_a" href="">tag2</a></li>
									<li><a class="normal_a" href="">tag2</a></li>
									<li><a class="normal_a" href="">tag2</a></li>
									<li><a class="normal_a" href="">tag2</a></li>
									<li><a class="normal_a" href="">tag2</a></li>
								</ul>
							</div>
						</div>
						<div class="dy_img-padding">
							<div style="background:url(images/1.jpg) repeat center center / cover transparent;" class="dy_img"></div>							
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function(){
		$(window).scroll(floatDIV);
		floatDIV();

		function floatDIV(){
			$('.floating_box').animate({
				top:$(document).scrollTop()+70+'px'
				},{
					duration:50,queue:false
			});
		}

		$('body').css('background','rgb(245,245,245)');
	});
</script>

<?php require('footer.php'); ?>