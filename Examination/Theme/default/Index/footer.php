	
	<footer style="">
		<div id="copy">
			<div class="container">
				<p>© 2015 Examination. All rights reserved.Developed by <a href="http://ivydom.com">ivydom.com</a> </p>
			</div>	
		</div>
	</footer>

	<script type="text/javascript">
		$(document).ready(function(){

			function displaySigninForm(){
				var form='<div class="login-panel"></div><div style="top:0" class="login-box"><div class="login_box_title"><h1><strong>Exam</strong>iantion</h1><div class="login_box_close"><img width="24"height="24"src="images/close.svg"></div></div><div class="login_box_content"><ul><li><div class="login_box_register">登录</div><div class="login_box_input"><input class="the_input light_blue"placeholder="请输入邮箱"style="width:92%"type="text"><input type="checkBox">记住我<input class="the_input light_blue"placeholder="请输入密码"style="width:92%"type="password"><div style="margin-top:-8px;margin-bottom:6px;"><a style="color:rgb(170,170,170);" href="">忘记密码</a></div><input type="button"class="the_btn light_blue white blue_border"value="登录"></div></li><li><div class="login_box_register">注册</div><div class="login_box_input"><input class="the_input light_blue"placeholder="请输入邮箱"style="width:92%"type="text"><input class="the_input light_blue"placeholder="请输入密码"style="width:92%"type="password"><input class="the_input light_blue"placeholder="请重复密码"style="width:92%"type="password"><input type="button"class="the_btn light_blue white blue_border"style="float:right"value="注册"></div></li></ul></div></div>';
				$('body').append(form);
				$('.login-box').css('top',($(window).height()-$('.login-box').height())/2-30)
						   .css('left',($(document).width()-$('.login-box').width())/2);
			}

			$('.login-panel,.login_box_close').live('click',function(){
				$('.login-panel').css('opacity','0');
				$('.login-box').css('opacity','0');
				$('.login-panel').fadeOut();
				$('.login-box').fadeOut(180);
			});
			
			$('.menu ul li').click(function(){
				if(typeof $(this).attr('action')=='undefined'){
					var ref=$(this).find('a').attr('ref');
					localStorage.currentIndex=ref;
					window.location.href=ref;
				}else{
					displaySigninForm();
				}
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

			$('.top_content').css('margin-top',$('header').height()+24);
			$('.cg').css('opacity','1');

			$('.menu ul li').hover(function(){
				var this_=$(this);
				var thisNext=this_.find('.menu-second-level');
				if(thisNext.length!=0){
					var thisID=thisNext.attr('id');
					var thisType=thisID.split('-')[1];
					var which2Display='page-'+thisType;
					var _thisSecondLevel=$('.menu ul li #'+which2Display);
					_thisSecondLevel.fadeIn(100);
					_thisSecondLevel.css({
						'top':$('header').height()+23,
						'width':this_.width()+12
					});
					
					this_.find('li').css({
						'width':this_.width+12+'px;'
					});
				}
			},function(){
				if($(this).find('.menu-second-level').length!=0){
					var thisS=$(this).find('.menu-second-level');
					thisS.fadeOut(50);	
				}
			});

		});
	</script>

</body>

</html>