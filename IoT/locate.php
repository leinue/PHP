<?php

$message=$_GET['message'];
if(strlen($message)==0){
	print('-2');//message为空
}else{
	locateByCURL($message);
}

function locateByCURL($msg){
	$url="http://quanapi.sinaapp.com/fetion.php";
	$curl=curl_init($url);
	curl_setopt($curl,CURLOPT_FAILONERROR,1);//如果发生错误直接停止运行
	curl_setopt($curl,CURLOPT_FOLLOWLOCATION,1);//使CURL支持重定向
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);//允许CURL请求返回数据
	curl_setopt($curl,CURLOPT_TIMEOUT,5);//设置timeout为5秒
	curl_setopt($curl,CURLOPT_POST,1);//使用POST方法
	curl_setopt($curl,CURLOPT_POSTFIELDS,"u=18115992267&p=7758521z&to=13155813086&m=$msg");//发送post数据
	$r=curl_exec($curl);
	curl_close($curl);
	print_r($r);
}

?>