<?php

$tmp=explode('\\', __DIR__);
array_pop($tmp);
array_pop($tmp);
array_pop($tmp);
$basedir='';
foreach ($tmp as $key => $value) {
	$basedir.=$value.'\\';
}
define('BASEDIR',$basedir);

require(BASEDIR.'/Cores/Loader.php');

if(!empty($_GET['cata_field_to_view'])){
	$cataObj=new Cores\Models\CataModel();
	$childList=$cataObj->getCataChild($_GET['cata_field_to_view']);
	if(!$childList){
		echo -1;//暂无数据或查找失败
	}else{
		echo json_encode($childList);
	}
}

if(!empty($_GET['cata_field_to_add']) && !empty($_GET['name'])){
	$cataObj=new Cores\Models\CataModel();
	$childList=$cataObj->addChild($_GET['name'],$_GET['cata_field_to_add'],null,true);
	if(!$childList){
		echo json_encode("暂无数据");
	}else{
		print_r(json_encode($childList));
	}
}

if(!empty($_GET['cata_field_second'])){
	$cataObj=new Cores\Models\CataModel();
	// $cataObj
}

?>