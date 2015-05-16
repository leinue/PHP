<?php  require('header.php'); ?>
	
	<section>
		<div class="introduction-home">
			<div class="cg"></div>
			<div class="illustration">
				<span>Examination</span>
				<span>每一天，乐在挑战</span>
			</div>
		</div>
		<div class="page">
			<div class="introduction-home introduction-second">
				<div class="introduction-font-big">
					<h1>Examination企划想法蜕变</h1>
					<div class="team-wrap">
					</div>
					<div class="intro-small">
						<p>次元纪行，是个打算把大家机器上活跃的各种软件拟人化然后战斗的想法
	也仅仅是个想法，想把类似于“3Q大战”萌化演绎出来的想法
	直到IE下葬的现在，依然无法付诸实现
	要扯到各大互联网产品公司并用他们的形象盈利，形象利用费用根本无力支付
	而且很难通过审查
	要是剧情创作有什么描写失实，被起诉也在所难免
	况且这个前辈太像它自己的前辈了，恐怕要在其阴影下失色</p>
					</div>
				</div>
				<div class="introduction-font-big">
					<h1>Examination企划背后的人</h1>
					<div class="team-wrap">
					</div>
				</div>
			</div>
		</div>
		
		<div id="separator">
			<div class="introduction-second event-form">
				<div class="span3" style="text-align:center">
					<h5>04,December,2014</h5>
					<h2>企划孕育</h2>
				</div>
				<div class="span3" style="text-align:center;background:#08AC67;">
					<h5>04,April,2015</h5>
					<h2>企划<p>二次商讨</p></h2>
				</div>
				<div class="span3" style="text-align:center;background:#1D7C80;">
					<h5>04,June,2015</h5>
					<h2>企划</h2>
				</div>
				<div class="span3" style="text-align:center;background:#2B4664;">
					<h5>04,June,2015</h5>
					<h2>LET'S DREAM IN 2015</h2>
				</div>
			</div>
		</div>
		<div class="introduction-home introduction-second introfuction-cg">
			<div class="introduction-font-big">
				<h1>Examination CG投稿</h1>
				<div class="intro-small intro-cg-small">
					<h2>强大的第三方资源库,可供二次开发</h2>
				</div>
			</div>
		</div>
		<div class="pixiv-form">
			<div class="box photograph web-design">
					<a class="iframe group1 cboxElement" href="" title="">
						<div class="box_img_div" style="background:url(images/slogan.jpg) repeat center center / cover transparent!important;"></div>
						<div class="mask"></div>
						<h4>Project Title</h4>
						<p>Some Text Here</p>
					</a>
				</div>
				<div class="box motion-graphics">
					<a class="iframe group1 cboxElement" href="project.html" title="">
						<div class="box_img_div" style="background:url(images/features.jpg) repeat center center / cover transparent!important;"></div>
						<div class="mask"></div>
						<h4>Project Title</h4>
						<p>Some Text Here</p>
					</a>
				</div>
				<div class="box motion-graphics">
					<a class="iframe group1 cboxElement" href="project.html" title="">
						<div class="box_img_div" style="background:url(images/index.jpg) repeat center center / cover transparent!important;"></div>
						<div class="mask"></div>
						<h4>Project Title</h4>
						<p>Some Text Here</p>
					</a>
				</div>
				<div class="box motion-graphics">
					<a class="iframe group1 cboxElement" href="project.html" title="">
						<div class="box_img_div" style="background:url(images/2.jpg) repeat center center / cover transparent!important;"></div>
						<div class="mask"></div>
						<h4>Project Title</h4>
						<p>Some Text Here</p>
					</a>
				</div>
				<div class="box motion-graphics">
					<a class="iframe group1 cboxElement" href="project.html" title="">
						<div class="box_img_div" style="background:url(images/1.jpg) repeat center center / cover transparent!important;"></div>
						<div class="mask"></div>
						<h4>Project Title</h4>
						<p>Some Text Here</p>
					</a>
				</div>
				<div class="box motion-graphics">
					<a class="iframe group1 cboxElement" href="project.html" title="">
						<div class="box_img_div" style="background:url(images/cg-post.jpg) repeat center center / cover transparent!important;"></div>
						<div class="mask"></div>
						<h4>Project Title</h4>
						<p>Some Text Here</p>
					</a>
				</div>
				<div class="box motion-graphics">
					<a class="iframe group1 cboxElement" href="project.html" title="">
						<div class="box_img_div" style="background:url(images/home2.jpg) repeat center center / cover transparent!important;"></div>
						<div class="mask"></div>
						<h4>Project Title</h4>
						<p>Some Text Here</p>
					</a>
				</div>
		</div>
		<div class="ask-ready-form">
			<h2>你准备好了吗，JUST DO IT</h2>
			<a class="the_btn btn-large">注册</a>
			<a class="the_btn btn-large dark">登录</a>
		</div>
		<div class="introduction-home introduction-second introfuction-cg introduction-slogan">
			<div class="introduction-font-big">
				<h1>让我们一起，创造更多莫名其妙的想法</h1>
			</div>
		</div>
	</section>
	<script type="text/javascript">
			var documentHeight=$(document).height();

			$('.introduction-home .cg').css('padding-top',$(document).height()-1600);

			function displayElement(elem,mode){
				if(mode=='display'){
					$(elem).css('opacity','1');
				}else{
					$(elem).css('opacity','0');
				}
			}

			$(window).scroll(function(){
				if($(document).scrollTop()>$('.introduction-home .cg').height()){
					$('header').css('opacity','1')
							   .css('background','#5B6073');
				}else{
					$('header').css('opacity','0.6')
							   .css('background','rgba(0,0,0,0.7)');
				}

				if($(document).scrollTop()>$('.introduction-home').height()-600){
					displayElement('.introduction-second','display');
				}else{
					displayElement('.introduction-second','hide');
				}

				if($(document).scrollTop()>$('.introfuction-cg').height()+$('.introduction-home').height()+$('.introduction-second').height()-200){
					displayElement('.pixiv-form','display');
				}else{
					displayElement('.pixiv-form','hide');
				}

				if($(document).scrollTop()>$('.introfuction-cg').height()+$('.introduction-home').height()+$('.introduction-second').height()+50){
					displayElement('.intro-cg-small','display');
				}else{
					displayElement('.intro-cg-small','hide');
				}

				if($(window).scrollTop()>=$(document).height()-$(window).height()-105){
					$('.introduction-slogan .introduction-font-big h1').attr('style','transform:scale(1.2);');
				}else{
					$('.introduction-slogan .introduction-font-big h1').attr('style','transform:scale(1);');
				}

				if($(document).scrollTop()>$('.introfuction-cg').height()+$('.introduction-home').height()+$('.introduction-second').height()+$('.pixiv-form').height()+$('#separator').height()+100){
					displayElement('.ask-ready-form','display');
				}else{
					displayElement('.ask-ready-form','hide');
				}


			});

			$('.ask-ready-form').css('margin-top',$('.web-design').height());
	</script>

	
<?php require('footer.php'); ?>
