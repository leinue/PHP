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
					<div class="user_profile_operation">
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
					</div>
					<div class="user_profile_operation">
						<div class="user_menu_title">
							<span>修改密码</span>
						</div>
						<div class="user_menu_content">
							<input class="the_input" placeholder="原密码" type="password">
							<input class="the_input" placeholder="新密码" type="password">
							<input class="the_input" placeholder="确认新密码" type="password">
							<a class="the_btn hover_black" style="padding:7.6px;" href="javascript:void(0)">确认修改</a>
						</div>
					</div>
					<div class="user_profile_operation">
						<div class="user_menu_title">
							<span>投稿管理</span>
						</div>
						<div class="user_menu_post_content">
							<table class="altrowstable" style="margin-top:10px;" id="alternatecolor">
								<tr>
									<th><input type="checkbox"></th>
									<th>作者</th>
									<th>标题</th>
									<th>分类</th>
									<th>类型</th>
									<th>发布日期</th>
									<th>更改日期</th>
									<th>点击数</th>
									<th>操作</th>
								</tr>
								<tr>
									<td><input type="checkbox"></td>
									<td>Text 1B</td><td>Text 1C</td><td>Text 1A</td><td>Text 1B</td><td>Text 1C</td><td>Text 1B</td><td>Text 1C</td>
									<td>
										<a class="the_btn hover_black" style="display:block">查看</a>
									</td>
								</tr>
								<tr>
									<td><input type="checkbox"></td>
									<td>Text 1B</td><td>Text 1C</td><td>Text 1A</td><td>Text 1B</td><td>Text 1C</td><td>Text 1B</td><td>Text 1C</td>
									<td>
										<a class="the_btn hover_black" style="display:block">查看</a>
									</td>								
								</tr>
								<tr>
									<td><input type="checkbox"></td>
									<td>Text 1B</td><td>Text 1C</td><td>Text 1A</td><td>Text 1B</td><td>Text 1C</td><td>Text 1B</td><td>Text 1C</td>
									<td>
										<a class="the_btn hover_black" style="display:block">查看</a>
									</td>								
								</tr>
								<tr>
									<td><input type="checkbox"></td>
									<td>Text 1B</td><td>Text 1C</td><td>Text 1A</td><td>Text 1B</td><td>Text 1C</td><td>Text 1B</td><td>Text 1C</td>
									<td>
										<a class="the_btn hover_black" style="display:block">查看</a>
									</td>								
								</tr>
								<tr>
									<td><input type="checkbox"></td>
									<td>Text 1B</td><td>Text 1C</td><td>Text 1A</td><td>Text 1B</td><td>Text 1C</td><td>Text 1B</td><td>Text 1C</td>
									<td>
										<a class="the_btn hover_black" style="display:block">查看</a>
									</td>								
								</tr>
							</table>

							<div class="pagination">
					<ul whole-page="233">
						<li>共 233 页</li>
						<li><a class="the_btn white" id="page_home" href="javascript:void(0)">首页</a></li>
						<li><a class="the_btn white pagination_active" id="page_1" href="javascript:void(0)">1</a></li>
						<li><a class="the_btn white" id="page_2" href="javascript:void(0)">2</a></li>
						<li><a class="the_btn white" id="page_3" href="javascript:void(0)">3</a></li>
						<li><a class="the_btn white" id="page_4" href="javascript:void(0)">4</a></li>
						<li><a class="the_btn white" id="page_5" href="javascript:void(0)">5</a></li>
						<li><a class="the_btn white" id="page_6" href="javascript:void(0)">6</a></li>
						<li><a class="the_btn white" id="page_7" href="javascript:void(0)">7</a></li>
						<li><a class="the_btn white" id="page_next" href="javascript:void(0)">下页</a></li>
						<li><a class="the_btn white" id="page_last" href="javascript:void(0)">末页</a></li>
						<li><input class="the_input small" id="page_page" type="number"></li>
						<li><a class="the_btn white" id="page_submit" href="javascript:void(0)">确定</a></li>
					</ul>
				</div>
							
						</div>
					</div>
					<div class="us	er_profile_operation">
						<div class="user_menu_title">
							<span>系统设置</span>
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
		function altRows(id){
			if(document.getElementsByTagName){  
				
				var table = document.getElementById(id);  
				var rows = table.getElementsByTagName("tr"); 
				 
				for(i = 0; i < rows.length; i++){          
					if(i % 2 == 0){
						rows[i].className = "evenrowcolor";
					}else{
						rows[i].className = "oddrowcolor";
					}      
				}
			}
		}
		window.onload=function(){
			altRows('alternatecolor');
		}
	</script>

<?php require('footer.php'); ?>