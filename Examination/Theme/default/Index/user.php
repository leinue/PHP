<?php require('header.php'); ?>

	<section>
	<div class="top_content">
		<div class="col-left">
			<ul>
				<li>
					<div class="user_menu_panel">
						<div class="user_menu_title">
							<span>用户中心</span>
						</div>
						<ul>
							<li class="user_menu_active">用户首页</li>
							<li>修改密码</li>
							<li>投稿管理</li>
							<li>系统设置</li>
						</ul>
					</div>
				</li>
				<li>
					<div class="user_menu_title">
						<span>我的信息</span>
					</div>
					<div class="user_menu_content">
						<div class="user_menu_profile">
							<div class="user_profile_photo">
								<img src="images/hello.jpg">
							</div>
							
							<div class="user_profile_detail">
								<div class="user_profile_name">
									<span>我的昵称：蛤蛤蛤蛤</span>
									<span>我的投稿：<span style="color：#1D7FB0!important;cursor:pointer;">233</span></span>
									<span><span>验证会员</span></span>
								</div>
								<div class="user_profile_name">
									<span>我的邮箱：597055914@qq.com></span>
								</div>
								<div class="user_profile_name">
									<span>最近登录：2015-05-13</span>
									<span>注册时间：<span>2015-05-12</span></span>
								</div>
							</div>

						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
		
	</section>	

	<script type="text/javascript">
		$(document).ready(function(){
			$('body').css('background','rgb(241,241,241)');
			$('.user_profile_photo img').css('height',$('.user_profile_photo img').width());
			$('.user_profile_detail').css('margin-top',-$('.user_profile_photo img').height()-4);
		});
	</script>

<?php require('footer.php'); ?>