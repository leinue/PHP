<footer>
    <?php
    	global $ashu_option;
    	echo $ashu_option['ashu']['tinymce_uniguy_copy_right'];
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

			function getExplorer() {
				var explorer = window.navigator.userAgent ;
				if (explorer.indexOf("MSIE") >= 0) {
					return "ie";
				}else if (explorer.indexOf("Firefox") >= 0){
					return "ff";
				}else if(explorer.indexOf("Chrome") >= 0){
					return "chrome";
				}else if(explorer.indexOf("Opera") >= 0){
					return "opera";
				}else if(explorer.indexOf("Safari") >= 0){
					return "safari";
				}
			}

			var explorer=getExplorer();

			if(explorer=='chrome'){
				var menuCount=$('.heading-big li').length;
				var inputPos=menuCount-1;
				$('.heading-big li:nth-child('+inputPos+')').css('margin-top','0');
			}

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
			headingLiHeight=liCount*headingLiHeight;

			//小屏幕时菜单弹出
			$('#list-toggle').click(function(){
				$('.heading-bottom').slideToggle();
				var elemHeight=$('.heading-bottom .heading-list').height()+400;
				var originGalleryHeadingMarginTop=$('.gallery-heading').css('marginTop');
				if(smallScreenMenuIsDisplayed){
					// if(screen.width<=350){
						$('.gallery-heading,.news-block,.content-panel').animate({
							marginTop:'-='+elemHeight+'px'
						},function(){
							$('.gallery-heading,.news-block,.content-panel').animate({
								marginTop:'0px'
							},function(){
								var caseSearchBtn=$('.case-block ul li#display-search span');
								if(caseSearchBtn!=0){
									caseSearchBtn.toggle();
								}
							});
						});
					// }
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
						'width':'100%',
						'text-align':'center'
					});

					// if(screen.width<=350){
						// alert('dssd');
						$('.gallery-heading,.news-block,.content-panel').animate({
							marginTop:'+='+elemHeight+'px'
						});
						smallScreenMenuIsDisplayed=true;
					// }

					var caseSearchBtn=$('.case-block ul li#display-search span');
					if(caseSearchBtn!=0){
						caseSearchBtn.hide();
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
