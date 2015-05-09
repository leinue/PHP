<?php

header("charset=utf8");

function curlPost($url,$argList){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $argList);
	$oupput=curl_exec($ch);
	curl_close($ch);
	return $oupput;
}


$phoneNumber=urlencode($_GET['phoneNumber']);
$password=urlencode($_GET['password']);
$securityNumber=urlencode($_GET['securityNumber']);
$userName=urlencode($_GET['userName']);

$post_data="phoneNumber=".$phoneNumber."&password=".$password."&securityNumber=".$securityNumber."&userName=".$userName;

print_r(curlPost("http://uniguyit.com:9989/WebService1.asmx/Registration",$post_data));

?>
