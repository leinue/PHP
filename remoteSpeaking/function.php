<?php

function test_input($data) {
  $data=trim($data);
  $data=stripslashes($data);
  $data=htmlspecialchars($data);
  return $data;
}

/*
* 在收到新消息时更新flag文件,flag文件数字自动往上加1
*/

function updateNew(){

$flag=file_get_contents('flag.txt');
if(strlen($flag)==null){
	$flag=0;
}

$flagFile=fopen("flag.txt", "w") or die("Unable to open file!");
if(!$flagFile){
	return '-1';//更新失败
}
$flag=$flag+1;
fwrite($flagFile, $flag);
fclose($flagFile);
return  '1';//更新成功

}

/*
* 判断oldflag文件内容与flag文件内容是否相同
* 如果相同代表目前没有新消息,如果不相同则代表有新消息
*/

function isHasNew(){

$oldflag=file_get_contents('oldflag.txt');
$flag=file_get_contents('flag.txt');

if(strlen($flag)==null || strlen($oldflag)==null){
	$flag=0;
	$oldflag=0;
}

if($flag==$oldflag){
	return '0';//表示没有新消息
}else{
	return '1';//表示有新消息
}

}

?>