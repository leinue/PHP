<?php
error_reporting(E_ALL ^ E_NOTICE);
require('config.php');

function createTable(){

	$sql=array(
		"location"=>"CREATE TABLE `location`( 
			`uid` int not null auto_increment, 
			`latitude` char(100) not null, 
			`longitude` char(100) not null, 
			primary key(`uid`) )default charset=utf8;");

	$pdo=new PDO("mysql:host=localhost;dbname=ncu",$user,$password);

	foreach ($sql as $key => $sqlStatement) {
		$res=$pdo->exec($sqlStatement);
		if(!$res){
			print_r($pdo->errorInfo());
		}
	}

}

createTable();
?>