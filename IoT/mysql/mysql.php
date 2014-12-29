<?php
error_reporting(E_ALL ^ E_NOTICE);
//配置数据库信息
$dbname="ncu";
$host="localhost";
$user="root";
$password="xieyang";

function createTable(){

	$sql=array(
		"location"=>"CREATE TABLE `location`( 
			`uid` int not null auto_increment, 
			`latitude` char(100) not null, 
			`longitude` char(100) not null, 
			primary key(`uid`) )default charset=utf8;");

	$pdo=new PDO("mysql:dbname=$dbname;host=$host",$user,$password);

	foreach ($sql as $key => $sqlStatement) {
		$res=$pdo->exec($sqlStatement);
		if(!$res){
			print_r($pdo->errorInfo());
		}
	}

}

createTable();
?>