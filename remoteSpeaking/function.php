<?php

function test_input($data) {
  $data=trim($data);
  $data=stripslashes($data);
  $data=htmlspecialchars($data);
  return $data;
}

/*
* 获得falg内容
*/

function getflag(){return file_get_contents('flag.txt');}

/*
* 获得oldflag内容
*/

function getOldFlag(){return file_get_contents('oldflag.txt');}

/*
* 更新oldFlag内容
*/

function updateOldFlag($flag){
	$flagFile=fopen("oldflag.txt", "w") or die("Unable to open file!");
	if(!$flagFile){
		return '-1';//更新失败
	}
	fwrite($flagFile, $flag);
	fclose($flagFile);
}

/*
* 在收到新消息时更新flag文件,flag文件数字自动往上加1
*/

function updateNew(){

$flag=getflag();
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

$oldflag=getOldFlag();
$flag=getflag();

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

/*
* 当用户获取新消息时更新oldflag,使oldflag和flag内容相同
*/

function syncFlag(){
	if(isHasNew()=='1'){
		updateOldFlag(getflag());
	}
}

?>