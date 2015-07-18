<footer>
    <?php
    	if($ashu_option['ashu']['tinymce_uniguy_copy_right']!=''){
    		echo $ashu_option['ashu']['tinymce_uniguy_copy_right'];    		
    	}else{
    		echo '<p>上海<span class="help">诸君信息科技</span>有限公司，保留业务与网站的最终解释权，<span class="help">2008-2015</span></p><p>上海市 闵行区 <span class="help">罗锦路55号C座210</span></p><p>QQ: <span class="help">2208934488</span> , 微信: <span class="help">uniguy</span> , 电邮: <span class="help">service@uniguyit.com</span></p>';
    	}
    ?>
 </footer>

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
			var headingListWidth=parseInt($('.heading-list').css('width'))/$(document).width()*100;
			$('#btn-search').click(function(){
				var docWidth=$(document).width();
				var inputWidth=0.16401778496362166531932093775263*docWidth;//记录搜索框的宽度,随屏幕大小改变
				if(inputSearchIsDiaplayed){
					$(".input-search").animate({
    					left:'0px',
    					width:'-='+inputWidth+'px'
  					},400,function(){
  						$('.heading-list').css('width',headingListWidth+'%');
  						$('.input-search').toggle();
  					});
  					$('.heading-list .heading-big .heading-input').css('width','0px');
  					inputSearchIsDiaplayed=false;
				}else{
					$('.heading-list').css('width','60%');
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

			var liCount=$('.heading-bottom ul li').length;

			var headingLiHeight=$('.heading-bottom .heading-list ul li').height();
			console.log(parseInt(headingLiHeight));
			headingLiHeight=liCount*headingLiHeight;
			console.log(headingLiHeight);

			//小屏幕时菜单弹出
			$('#list-toggle').click(function(){
				$('.heading-bottom').slideToggle();
				var elemHeight=$('.heading-bottom .heading-list').height()+400;
				var originGalleryHeadingMarginTop=$('.gallery-heading').css('marginTop');
				if(smallScreenMenuIsDisplayed){
					if(screen.width<=350){
						$('.gallery-heading,.news-block').animate({
							marginTop:'-='+elemHeight+'px'
						},function(){
							$('.gallery-heading,.news-block').animate({
								marginTop:'0px'
							});
						});
					}
					smallScreenMenuIsDisplayed=false;
				}else{

					$('.heading-bottom').css({
						'display':'block',
						'height':headingLiHeight,
						'position':'relative'
					});
					
					$('.heading-bottom .heading-list ul li').css({
						'display':'block',
						'margin-bottom':'10px',
						'width':'100%'
					});
					
					if(screen.width<=350){
						$('.gallery-heading,.news-block').animate({
							marginTop:'+='+elemHeight+'px'
						});
						smallScreenMenuIsDisplayed=true;
					}
				}
			});

			$('.heading-bottom .heading-list ul li').click(function(){
				window.location.href=$(this).find('a').attr('href');
			});

			$(window).scroll(floatMenuCase);

			var isMenuFloated=false;
			var isCaseMenuSlided=false;

			function floatMenuCase(){
				if($(document).scrollTop()>46){
					isMenuFloated=true;
					$('.case-block').css('position','fixed')
								.css('top','0px')
								.css('width','100%')
								.css('marginLeft','0px');
					$('.case-block ul #case-top-title').css('paddingLeft','14.8999258%');
					$('.case-block ul #display-search').css('paddingRight','13.343217%');
					$('.case-menu-display').css('position','relative')
										.css('paddingLeft','14.8999258%')
										.css('paddingRight','13.343217%');
					if(isCaseMenuSlided){
						$('.case-menu-display').hide();
						isCaseMenuSlided=false;
					}
				}else{
					isMenuFloated=false;
					$('.case-block').css('position','relative')
									.css('width','71.74231%')
									.css('marginLeft','14.928843%');
					$('.case-block ul #case-top-title').css('paddingLeft','0px');
					$('.case-block ul #display-search').css('paddingRight','0px');
					$('.case-menu-display').css('position','relative')
										.css('paddingLeft','0')
										.css('paddingRight','0');
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

			//案例页面弹出小框
			var orignPaddingLeft="14.8999%";
			var orignPadingRight="13.3432%";
			$('.case-block ul #display-search').click(function(){
				if(!isCaseMenuSlided){
					$('#display-search').css('padding-right','20px');
					$('#case-top-title').css('padding-left','20px');
					isCaseMenuSlided=true;
				}else{
					if(!isMenuFloated){
						orignPadingRight="0px";
						orignPaddingLeft="0px";
					}else{
						orignPaddingLeft="14.8999%";
							orignPadingRight="13.3432%";
					}
					$('#display-search').css('padding-right',orignPadingRight);
					$('#case-top-title').css('padding-left',orignPaddingLeft);
					isCaseMenuSlided=false;
				}
				$('.case-menu-display').toggle();
			});
		});
	</script>

</body>
</html>
