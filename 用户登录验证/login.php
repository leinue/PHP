<?php

$user='admin';
$pass='password';

if(trim($_POST['name'])==$user && trim($_POST['password'])==$pass){
	session_start();
	$_SEESION['admin']=1;
	$_SEESION['admin']=$user;
	header("location:manage.php");
}

?>