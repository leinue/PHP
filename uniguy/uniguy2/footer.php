<footer>
	<p>上海<span class="help">诸君信息科技</span>有限公司，保留业务与网站的最终解释权，<span class="help">2008-2015</span></p>
	<p>上海市 闵行区 <span class="help">罗锦路55号C座210</span></p>
	<p>QQ: <span class="help">2208934488</span> , 微信: <span class="help">uniguy</span> , 电邮: <span class="help">service@uniguyit.com</span></p>
</footer>

	<script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
	<script>
		$(document).ready(function(){

			$('.input-search').hide();

			$('#btn-search,.heading-menu').hover(
				function(){
					$(this).stop().animate({opacity:0.6},'fast');
				},
				function(){
					$(this).stop().animate({opacity:1},'fast');
				}
			);

			var inputSearchIsDiaplayed=false;
			$('#btn-search').click(function(){
				
				if(inputSearchIsDiaplayed){
					$(".input-search").animate({
    					left:'150px',
    					width:'-=140px'
  					});
  					inputSearchIsDiaplayed=false;
				}else{
					$(".input-search").animate({
    					left:'250px',
    					width:'+=140px'
  					});
  					inputSearchIsDiaplayed=true;
				}
				$('.input-search').toggle();
			});

		});
	</script>

</body>
</html>