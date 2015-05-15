<?php require('header.php') ?>

<section>
	<div class="top_content">
		<div class="dy_display">
			<ul>
				<li>
					<div class="floating_box">
						<div style="background:url(images/hello.jpg) repeat center center / cover transparent;" class="profile_photo"></div>
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
							<div style="width:100%;" class="dy_tags">
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
			$('.floating_box').css('height',$(document).height()-$(document).scrollTop()-$('footer').height()-90);
		}

		$('body').css('background','rgb(251,251,251)');
		$('.floating_box').css('height',$('.dy_content').height());
	});
</script>

<?php require('footer.php'); ?>
