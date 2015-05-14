	
	<footer>
		<div id="copy">
			<div class="container">
				<p>© 2015 Examination. All rights reserved.Developed by <a href="http://ivydom.com">ivydom</a> </p>
			</div>	
		</div>
	</footer>

	<script type="text/javascript">
		$(document).ready(function(){
			var documentHeight=$(document).height();

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

			$('.introduction-home .cg').css('padding-top',documentHeight-1800);

			$('.ask-ready-form').css('margin-top',$('.web-design').height());

		});
	</script>

</body>

</html>