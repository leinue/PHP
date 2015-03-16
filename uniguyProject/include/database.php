<?php

require('config.php');

function createTable($dbname,$host,$name,$pw){

	$sql=array(
		"fmdb_user"=>"CREATE TABLE IF NOT EXISTS `fmdb_user`( 
			`uid` int not null auto_increment, 
			`name` text not null,
    		`password` text not null,
    		`starCount` int not null,
    		`downloadCount` int not null,
    		`privilege` int not null,
    		`userpath` text not null,
     		`lastLoginTime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
			primary key(`uid`))default charset=utf8;",
		"fmdb_file"=>"CREATE TABLE IF NOT EXISTS `fmdb_file`(
			`fid` int not null auto_increment,
			`uid` int not null,
			`path` text not null,
			`fileExt` text not null,
			`tags` text not null,
			`isStard` int not null,
			`isDeleted` int not null,
			`downloadCount` int not null,
			`isDisplayed` int not null,
			`createTime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			primary key(`fid`))default charset=utf8;",
		"fmdb_download"=>"CREATE TABLE IF NOT EXISTS `fmdb_download`(
			`donid` int not null auto_increment,
			`fid` int not null,
			`uid` int not null,
			`downloadTime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			primary key(`donid`))default charset=utf8;",
		"fmdb_stars"=>"CREATE TABLE IF NOT EXISTS `fmdb_stars`( 
			`stid` int not null auto_increment, 
			`uid` text not null,
			`fid` int not null,
			primary key(`stid`))default charset=utf8;",
		"fmdb_comments"=>"CREATE TABLE IF NOT EXISTS `fmdb_comments`(
			`coid` int not null auto_increment,
			`fid` int not null,
			`uid` int not null,
			`content` text not null,
			`commentTime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			primary key(`coid`))default charset=utf8;",
		"fmdb_workpoints"=>"CREATE TABLE IF NOT EXISTS `fmdb_workpoints`(
			`wpid` int not null auto_increment,
			`uid` int not null,
			`fid` int not null,
			`grade` int not null,
			primary key(`wpid`))default charset=utf8;"
	);

	$pdo=new PDO("mysql:dbname=$dbname;host=$host",$name,$pw);

	foreach ($sql as $key => $sqlStatement) {
		$res=$pdo->exec($sqlStatement);
		if(!$res){
			print_r($pdo->errorInfo());
		}
	}

}

createTable($dbname,$host,$user,$password);

?>