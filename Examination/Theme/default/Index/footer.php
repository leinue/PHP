	
	<footer style="">
		<div id="copy">
			<div class="container">
				<p>© 2015 Examination. All rights reserved.Developed by <a href="http://ivydom.com">ivydom.com / xieyang</a> </p>
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

			function getMaskSelector(obj){
				var selector;
				if($(obj).find('.link_home').length==0){
					selector='.mask,h4,p';
				}else{
					selector='.mask';
				}
				return selector;
			}

			$('.pixiv-form,.box_img_div').css('opacity','1');
			$('.pixiv-form .box a,.cont_box').hover(function(){
				$(this).find(getMaskSelector(this)).css('opacity','1');
			},function(){
				$(this).find(getMaskSelector(this)).css('opacity','0');
			});

			$('.top_content').css('margin-top',$('header').height()+30);
			$('.cg').css('opacity','1');

		});
	</script>

</body>

</html>