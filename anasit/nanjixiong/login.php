<?php

error_reporting(E_ALL & ~E_NOTICE);

define('BASEDIR',__DIR__);
require(BASEDIR.'/Cores/Loader.php');

session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>登录</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css">  
  	<script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
  	<script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  	<style type="text/css">
		.login-page {
		    position: absolute;
		    top: 0px;
		    left: 0px;
		    right: 0px;
		    bottom: 0px;
		    overflow: auto;
		    background: #3CA2E0 none repeat scroll 0% 0%;
		    text-align: center;
		    color: #FFF;
		    padding: 3em;
		}

		.login-panel {
		    margin-top: 25%;
		    background-color: transparent!important;
		    border: medium none;
		}

		.panel {
		    border-radius: 0px;
		    border-color: #F1F2F3;
		    box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.05);
		}

		.panel-default {
		    border-color: #DDD;
		}

		.panel {
		    margin-bottom: 20px;
		    background-color: #FFF;
		    border: 1px solid transparent;
		    border-radius: 4px;
		    box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.05);
		}

  	</style>
</head>
<body>

	<?php

		if(!empty($_GET['action'])){
			if($_GET['action']=='login'){

				$username=$_POST['username'];
				$userpw=$_POST['userpw'];

				if($username==null || $userpw==null){
					echo "<script>alert('请完整填写信息')</script>";
				}else{

					
				    $ch = curl_init('http://www.nanjixiong.com/login.php?username='.$username.'&password='.$userpw);
				    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);  
				    $output = curl_exec($ch);
				    switch ($output) {
				    	case '-1'://用户不存在
				    		$prompt=success('用户不存在');
				    		break;
				    	case '-2'://密码错误
				    		$prompt=success('密码错误');
				    		break;
				    	case '0'://未定义
				    		$prompt=success('未定义');
				    		break;
				    	default://验证通过
				    		$prompt=success('验证通过,即将跳转...');
				    		$usersObj=new Cores\Models\UsersModel();
				    		$userInfo=$usersObj->userExists($username);
				    		if($userInfo){
				    			$_SESSION['username']=$username;
				    			$_SESSION['privilege']=$userInfo[0]['privilege'];
				    			$_SESSION['uid']=$userInfo[0]['uid'];
				    			$_SESSION['isAdmin']=$_SESSION['privilege']==='0';
				    		}else{
				    			$privilege=$username=='admin'?'0':'127';
				    			$userAdded=$usersObj->add($username,$username,$privilege);
				    			$_SESSION['username']=$username;
				    			$_SESSION['privilege']=$userAdded[0]->getPrivilege();
				    			$_SESSION['uid']=$userAdded[0]->getUid();
				    			$_SESSION['isAdmin']=$_SESSION['privilege']==='0';
				    		}

				    		$prompt.='<script>setTimeout("window.location.href=\'index.php\'",2000)</script>';
				    		break;
				    }

				}

			}
		}

	?>
	<div class="container">
	    <div class="login-page">
		    <div class="row">
		        <div class="col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4">
		            <div style="text-align:center" class="login-panel panel panel-default">
		                <img src="flat-avatar.png" class="user-avatar">
		                <h1>登录 <small></small<?php echo $prompt; ?></h1>
		                <div class="panel-body">
		                    <form role="form" method="post" action="login.php?action=login">
		                        <fieldset>
		                            <div class="form-group">
		                                <input class="form-control" placeholder="用户名" name="username" type="text" autofocus>
		                            </div>
		                            <div class="form-group">
		                                <input class="form-control" placeholder="密码" name="userpw" type="password" value="">
		                            </div>
		                            <div class="checkbox">
		                                <label>
		                                    <input name="remember" type="checkbox" value="Remember Me">记住密码
		                                </label>
		                                <a target="_blank" href="http://www.nanjixiong.com/member.php?mod=register">没有帐号?去注册</a>
		                            </div>
		                            <input id="login" type="submit" class="btn btn-lg btn-success btn-block" value="登录">
		                        </fieldset>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>
	    </div>
	</div>
	<script type="text/javascript">
		// $('#login').click(function(){

		// 	console.log('ddss');
		// });
	</script>
</body>
</html>
