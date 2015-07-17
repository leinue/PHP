	<section>
	<?php
		$caseData=$ashu_option['case'];
	?>
		<div class="news-block case-block">
 			<ul>
 				<li id="case-top-title"><a href="">案例</a></li>
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

		<div class="column-content">
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
				
		</div>
	</section>
