	
	<footer style="">
		<div id="copy">
			<div class="container">
				<p>© 2015 Examination. All rights reserved.Developed by <a href="http://ivydom.com">ivydom</a> </p>
			</div>	
		</div>
	</footer>

	<script type="text/javascript">
		$(document).ready(function(){
			
			$('.menu ul li').click(function(){
				var ref=$(this).find('a').attr('ref');
				localStorage.currentIndex=ref;
				window.location.href=ref;
				return false;
			});

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