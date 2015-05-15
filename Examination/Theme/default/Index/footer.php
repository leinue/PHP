	
	<footer style="">
		<div id="copy">
			<div class="container">
				<p>© 2015 Examination. All rights reserved.Developed by <a href="http://ivydom.com">ivydom</a> </p>
			</div>	
		</div>
	</footer>

	<script type="text/javascript">
		$(document).ready(function(){

			$('.pixiv-form,.box_img_div').css('opacity','1');
			$('.pixiv-form .box a').hover(function(){
				$(this).find('.mask,h4,p').css('opacity','1');
			},function(){
				$(this).find('.mask,h4,p').css('opacity','0');
			});

			$('.top_content').css('margin-top',$('header').height()+30);

		});
	</script>

</body>

</html>