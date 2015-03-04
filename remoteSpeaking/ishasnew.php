<?php

/*
* 判断oldflag文件内容与flag文件内容是否相同
* 如果相同代表目前没有新消息,如果不相同则代表有新消息
*/


$oldflag=file_get_contents('oldflag.txt');
$flag=file_get_contents('flag.txt');

if(strlen($flag)==null || strlen($oldflag)==null){
	$flag=0;
	$oldflag=0;
}

if($flag==$oldflag){
	echo '0';//表示没有新消息
}else{
	echo '1';//表示有新消息
}

?>