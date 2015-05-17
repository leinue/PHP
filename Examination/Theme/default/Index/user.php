<?php require('header.php'); ?>

	<section>
		
	</section>
	
	<div class="login-panel">
	</div>
		<div class="login-box">
			<div class="login_box_title">
				<h1><strong>Exam</strong>iantion</h1>
				<div class="login_box_close">
					<img width="24" height="24" src="images/close.svg">
				</div>
			</div>
			<div class="login_box_content">
				<ul>
					<li>
						<div class="login_box_register">登录</div>
						<div class="login_box_input">
							<input class="the_input light_blue" placeholder="请输入邮箱" style="width:92%" type="text">
							<input type="checkBox">记住我
							<input class="the_input light_blue" placeholder="请输入密码" style="width:92%" type="password">
							<input type="button" class="the_btn light_blue white blue_border" value="登录">
						</div>
					</li>
					<li>
						<div class="login_box_register">注册</div>
						<div class="login_box_input">
							<input class="the_input light_blue" placeholder="请输入邮箱" style="width:92%" type="text">
							<input class="the_input light_blue" placeholder="请输入密码" style="width:92%" type="password">
							<input class="the_input light_blue" placeholder="请重复密码" style="width:92%" type="password">
							<input type="button" class="the_btn light_blue white blue_border" style="float:right" value="登录">
						</div>					
					</li>
				</ul>
			</div>
		</div>


	<script type="text/javascript">
		$(document).ready(function(){
			$('body').css('background','rgb(241,241,241)');

			$('.login-panel,.login_box_close').click(function(){
				$('.login-panel').css('opacity','0');
				$('.login-box').css('opacity','0');
				$('.login-panel').fadeOut();
				$('.login-box').fadeOut(180);
			});

			$('.login-box').css('margin-top',($(document).height()-$('.login-box').height())/2-30)
						   .css('left',($(document).width()-$('.login-box').width())/2);
		});
	</script>

<?php require('footer.php'); ?>