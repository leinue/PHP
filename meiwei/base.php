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


$mobile=$_GET['mobile'];
$ran=$_GET['ran'];
$userid="";
$account="xd000676";
$password="xd00067612";
$content="您的验证码:".$ran."【美位生活】";
$sendTime="2015-05-07";
$action="send";
$extno="";

$post_data=array("mobile"=>$mobile,
	"userid"=>$userid,
	"account"=>$account,
	"password"=>$password,
	"content"=>$content,
	"sendTime"=>$sendTime,
	"action"=>$action,
	"extno"=>$extno);

print_r(curlPost("http://dx.ipyy.net/smsJson.aspx",$post_data));

?>
