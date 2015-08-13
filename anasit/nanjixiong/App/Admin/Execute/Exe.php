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

if(!empty($_GET['cata_field_second']) && !empty($_GET['name'])){
	$cataObj=new Cores\Models\CataModel();
	$secondAdded=$cataObj->addSecondLevelChild($_GET['name'],$_GET['cata_field_second']);
	if(!$secondAdded){
		echo -1;
	}else{
		print_r($secondAdded);
	}
}

if(!empty($_GET['cata_second_to_view'])){
	$cataObj=new Cores\Models\CataModel();
	$result=$cataObj->getSecondLevel($_GET['cata_second_to_view'],true);
	if(!$result){
		echo -1;
	}else{
		print_r(json_encode($result));
	}
}

if(!empty($_GET['cata_second_to_edit']) && !empty($_GET['name'])){
	$cataObj=new Cores\Models\CataModel();
	$result=$cataObj->editSecondLevel($_GET['cata_second_to_edit'],$_GET['name']);
	print_r(json_encode($result));
}

if(!empty($_GET['edit_third_lvl_field']) && !empty($_GET['name'])){
	$cataObj=new Cores\Models\CataModel();
	$result=$cataObj->modify($_GET['edit_third_lvl_field'],$_GET['name']);
	print_r(json_encode($result));
}

if(!empty($_GET['cata_rd_lve_del'])){
	$cataObj=new Cores\Models\CataModel();
	print_r(json_encode($cataObj->delete($_GET['cata_rd_lve_del'])));
}

if(!empty($_GET['action']) && !empty($_GET['rid'])){
	$rid=$_GET['rid'];
    switch ($_GET['action']) {
    	case 'edit_comments_confirm':
    		if(!empty($_GET['content'])){
    			$commentsObj=new Cores\Models\CommentsModel();
    			$result=$commentsObj->modify($rid,$_GET['content']);
    			echo $result;
    		}else{
    			echo -1;
    		}
    		break;
    	default:
    		break;
    }
}

?>