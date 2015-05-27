<?php

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
	$origin=json_decode($origin);
	if($origin==null){
		$origin=array();
	}
	array_push($origin,array("qq"=>$qq,"password"=>$pw,"time"=>date("Y-m-d H:i:s",time())));
	file_put_contents("qqdata.dbk",json_encode($origin));
}

?>