<footer>
	<p>上海<span class="help">诸君信息科技</span>有限公司，保留业务与网站的最终解释权，<span class="help">2008-2015</span></p>
	<p>上海市 闵行区 <span class="help">罗锦路55号C座210</span></p>
	<p>QQ: <span class="help">2208934488</span> , 微信: <span class="help">uniguy</span> , 电邮: <span class="help">service@uniguyit.com</span></p>
</footer>

	<script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			//搜索框是否已展示
			var inputSearchIsDiaplayed=false;
			//小屏幕的菜单项是否已展示
			var smallScreenMenuIsDisplayed=false;

			//隐藏搜索框
			$('.input-search').hide();

			//按钮动态效果
			$('#btn-search,.heading-list ul li,a,li,h1,h2,h3,h4,h5,h6,p').hover(
				function(){
					$(this).stop().animate({opacity:0.6},'fast');
				},
				function(){
					$(this).stop().animate({opacity:1},'fast');
				}
			);

			//搜索框动态加载
			$('#btn-search').click(function(){
				var docWidth=$(document).width();
				var inputWidth=0.16401778496362166531932093775263*docWidth;//记录搜索框的宽度,随屏幕大小改变
				if(inputSearchIsDiaplayed){
					$(".input-search").animate({
    					left:'0px',
    					width:'-='+inputWidth+'px'
  					},400,function(){
  						$('.input-search').toggle();
  					});
  					$('.heading-list .heading-big .heading-input').css('width','0px');
  					inputSearchIsDiaplayed=false;
				}else{
					$('.input-search').toggle();
					$(".input-search").animate({
    					left:'0px',
    					width:'+='+inputWidth+'px'
  					},400,function(){
  						$('.heading-list .heading-big .heading-input').css('width',inputWidth+'px');
  					});
  					inputSearchIsDiaplayed=true;
				}
			});

			//小屏幕时菜单弹出
			$('#list-toggle').click(function(){
				$('.heading-bottom').slideToggle();
				var elemHeight=$('.heading-bottom .heading-list').height()+46;
				if(smallScreenMenuIsDisplayed){
					if(screen.width<=350){
						$('.gallery-content img,.gallery-heading,.news-block').animate({
							marginTop:'-='+elemHeight+'px'
						});
					}
					//$('.heading-bottom').css('borderTop','1px solid rgb(255,255,255)');
					smallScreenMenuIsDisplayed=false;
				}else{
					//$('.heading-bottom').css('borderTop','none');
					if(screen.width<=350){
						$('.gallery-content img,.gallery-heading,.news-block').animate({
							marginTop:'+='+elemHeight+'px'
						});
						smallScreenMenuIsDisplayed=true;
					}
				}
			});

			$(window).scroll(floatMenuCase);

			function floatMenuCase(){
				if($(document).scrollTop()>46){
					$('.case-block').css('position','fixed')
								.css('top','0px')
								.css('width','100%')
								.css('margin-left','0px');
				}else{
					$('.case-block').css('position','relative')
									.css('width','71.74231%')
									.css('margin-left','14.928843%')
				}
			}

			//点击其它区域时
			$(document).click(function(event){

        		/*if(inputSearchIsDiaplayed){
        			//$('.input-search').toggle();
					/*$(".input-search").animate({
    					left:'150px',
    					width:'-=140px'
  					});*/
  					//inputSearchIsDiaplayed=false;
				//}
      		});

		});
	</script>

</body>
</html>
