<?php

error_reporting(E_ALL & ~E_NOTICE);

$cls=locateByCURL($message);
$pos='{"x":"'.$cls->content->point->x.'","y":"'.$cls->content->point->y.'"}';
echo $pos;

function locateByCURL($msg){
	$url="http://api.map.baidu.com/location/ip";
	$curl=curl_init($url);
	curl_setopt($curl,CURLOPT_FAILONERROR,1);//如果发生错误直接停止运行
	curl_setopt($curl,CURLOPT_FOLLOWLOCATION,1);//使CURL支持重定向
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);//允许CURL请求返回数据
	curl_setopt($curl,CURLOPT_TIMEOUT,5);//设置timeout为5秒
	curl_setopt($curl,CURLOPT_POST,1);//使用POST方法
	curl_setopt($curl,CURLOPT_POSTFIELDS,"ak=qiryZH459sCKgpGEh9EkoDx0&coor=bd09ll");//发送post数据
	$r=curl_exec($curl);
	curl_close($curl);
	$r=json_decode($r);
	return $r;
}
?>