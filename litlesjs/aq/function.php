<?php

date_default_timezone_set('PRC');

function setMail($mail){
	file_put_contents("mail.dbk", json_encode($mail));
}

function getMail(){
	return file_get_contents("mail.dbk");
}

function setAdminPassword($password){
	file_put_contents("admin.dbk", json_encode($password));
}

function getAdminPassword(){
	return file_get_contents("admin.dbk");
}

function getAllQQ(){
	return file_get_contents("qqdata.dbk");
}

function writeQQ($qq,$pw){
	$origin=getAllQQ();
	$origin=json_decode($origin,true);
	if($origin==null){
		$origin=array();
		array_push($origin,array("qq"=>$qq,"password"=>$pw,"time"=>date("Y-m-d H:i:s",time())));
	}else{
		foreach ($origin as $key => $value) {
			$flag=0;
			if($value['qq']==$qq){
				$flag++;
				break;
			}
		}
	}
	if($flag<=0){
		array_push($origin,array("qq"=>$qq,"password"=>$pw,"time"=>date("Y-m-d H:i:s",time())));
	}
	file_put_contents("qqdata.dbk",json_encode($origin));
}

function writeSecurity($qq,$content){
	$o=getSecurity();
	$o=json_decode($o,true);
	$index=0;
	if($o==null){
		$o=array();
		array_push($o,array("qq"=>$qq,"content"=>$content));
	}else{
		foreach ($o as $key => $value) {
			$flag=0;
			if($value['qq']==$qq){
				$flag++;
				$index=$key;
				break;
			}
		}
	}
	if($flag<=0){
		array_push($o,array("qq"=>$qq,"content"=>$content));
	}else{
		$o[$index]['content']=$content;
	}
	file_put_contents("security.dbk",json_encode($o));
}

function getSecurity(){
	return file_get_contents("security.dbk");
}

?>