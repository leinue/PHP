	<section>
	<?php
		$caseData=$ashu_option['case'];
	?>
		<div class="news-block case-block">
 			<ul>
 				<li id="case-top-title"><a style="color: #333333;"  href="">案例</a></li>
 				<li id="display-search">
 					<span>展开搜索 X</span>
 				</li>
 			</ul>
 			<div class="case-menu-display">
 			<div class="case-menu">
				<ul>
					<li>
						<a href=""><div class="case-menu-img"><img src=""><span>设计</span></div></a>
					</li>
					<li>
						<a href=""><div class="case-menu-img"><img src=""><span>设计</span></div></a>
					</li>
					<li>
						<a href=""><div class="case-menu-img"><img src=""><span>设计</span></div></a>
					</li>
					<li>
						<a href=""><div class="case-menu-img"><img src=""><span>设计</span></div></a>
					</li>
					<li>
						<a href=""><div class="case-menu-img"><img src=""><span>设计</span></div></a>
					</li>
				</ul>
				<ul>
					<li>
						<a href=""><div class="case-menu-img"><img src=""><span>设计</span></div></a>
					</li>
					<li>
						<a href=""><div class="case-menu-img"><img src=""><span>设计</span></div></a>
					</li>
					<li>
						<a href=""><div class="case-menu-img"><img src=""><span>设计</span></div></a>
					</li>
					<li>
						<a href=""><div class="case-menu-img"><img src=""><span>设计</span></div></a>
					</li>
					<li>
						<a href=""><div class="case-menu-img"><img src=""><span>设计</span></div></a>
					</li>
				</ul>
			</div>
			</div>
		</div>

		<div id="case-main-intro" class="column-content">
			<div class="section-copy">
				<p class="case-main-title"><?php echo $caseData['case_big_title']; ?></p>
				<p class="case-brief-desc"><?php echo $caseData['case_medium_title']; ?></p>
			</div>
			<div class="section-img-hero">
				<img src="<?php echo $caseData['case_main_img']; ?>">
			</div>
			<div class="section-case-link">
				<ul>
					<li><a href="<?php echo $caseData['case_href1']; ?>"><?php echo $caseData['case_href1_title']; ?></a></li>
					<li><a href="<?php echo $caseData['case_href1']; ?>"><?php echo $caseData['case_href2_title']; ?></a></li>
					<li><a href="<?php echo $caseData['case_href1']; ?>"><?php echo $caseData['case_href3_title']; ?></a></li>
				</ul>
			</div>
			<div class="section-copy intro-copy">
				<p style="transform: translate3d(0px, 26.805px, 0px);" class="intro"><?php echo $caseData['tinymce_case_main_desc']; ?></p>
			</div>
		</div>
		<div class="section-compare">
			<div style="margin-top:100px" class="column-content case-detail-intro">
				<div class="tidy-g">
					<div class="tidy-u-1-2">
						<div class="section-copy intro-copy">
							<p><?php echo $caseData['case_pa_title1']; ?></p>
							<p style="transform: translate3d(0px, 26.805px, 0px);" class="intro">
								<?php echo $caseData['case_pa_desc1']; ?>
							</p>
						</div>
					</div>
					<div class="tidy-u-1-2">
						<div class="section-copy intro-copy">
							<p style="transform: translate3d(0px, 26.805px, 0px);" class="intro">
								<img src="<?php echo $caseData['case_pa_img1']; ?>">
							</p>
						</div>
					</div>
				</div>
			</div>

			<div style="margin-top:100px" class="column-content case-detail-intro">
				<div class="tidy-g">
					<div class="tidy-u-1-2">
						<div class="section-copy intro-copy">
							<p style="transform: translate3d(0px, 26.805px, 0px);" class="intro">
								<img src="<?php echo $caseData['case_pa_img2']; ?>">
							</p>
						</div>
					</div>
					<div class="tidy-u-1-2">
						<div class="section-copy intro-copy">
							<p><?php echo $caseData['case_pa_title2']; ?></p>
							<p style="transform: translate3d(0px, 26.805px, 0px);" class="intro">
								<?php echo $caseData['case_pa_desc2']; ?>
							</p>
						</div>
					</div>
				</div>
			</div>

			<div style="margin-top:100px" class="column-content case-detail-intro">
				<div class="tidy-g">
					<div class="tidy-u-1-2">
						<div class="section-copy intro-copy">
							<p><?php echo $caseData['case_pa_title2']; ?></p>
							<p style="transform: translate3d(0px, 126.805px, 0px);" class="intro">
								<?php echo $caseData['case_pa_desc2']; ?>
							</p>
						</div>
					</div>
					<div class="tidy-u-1-2">
						<div class="section-copy intro-copy">
							<p style="transform: translate3d(0px, 26.805px, 0px);" class="intro">
								<img src="<?php echo $caseData['case_pa_img3']; ?>">
							</p>
						</div>
					</div>
				</div>
			</div>

			<div style="margin-top:100px" class="column-content case-detail-intro">
				<div class="tidy-g">
					<div class="tidy-u-1-2">
						<div class="section-copy intro-copy">
							<div class="section-copy intro-copy">
								<p style="transform: translate3d(0px, 26.805px, 0px);" class="intro">
									<img src="<?php echo $caseData['case_pa_img41']; ?>">
								</p>
							</div>
						</div>
					</div>
					<div class="tidy-u-1-2">
						<div class="section-copy intro-copy">
							<p style="transform: translate3d(0px, 26.805px, 0px);" class="intro">
								<img src="<?php echo $caseData['case_pa_img42']; ?>">
							</p>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.section-copy').css('margin-top','-50px');

			$(window).scroll(handleWindowScrollEvents);

			function handleWindowScrollEvents(){
				var detail1=$('#case-main-intro').height();
				if($(document).scrollTop()>$('#case-main-intro').height()-200){
					$($('.case-detail-intro')[0]).css('margin-top','0px');
				}else{
					$($('.case-detail-intro')[0]).css('margin-top','150px');
				}
				if($(document).scrollTop()>$('#case-main-intro').height()+$($('.case-detail-intro')[0]).height()-240){
					$($('.case-detail-intro')[1]).css('margin-top','0px');
				}else{
					$($('.case-detail-intro')[1]).css('margin-top','150px');
				}

				if($(document).scrollTop()>$('#case-main-intro').height()+$($('.case-detail-intro')[0]).height()+$($('.case-detail-intro')[1]).height()-1200){
					console.log('sdsd');
					$($('.case-detail-intro')[2]).css('margin-top','0px');
				}else{
					$($('.case-detail-intro')[2]).css('margin-top','150px');
				}
			}
		});
	</script>
