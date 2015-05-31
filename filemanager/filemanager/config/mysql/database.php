<?php

require('config.php');

function createTable($dbname,$host,$name,$pw){

	$sql=array(
		"fmdb_user"=>"CREATE TABLE IF NOT EXISTS `fmdb_user`( 
			`id` int not null auto_increment,
			`uid` text not null,
			`name` text not null,
    		`password` text not null,
    		`starCount` int not null,
    		`downloadCount` int not null,
    		`privilege` int not null,
    		`group` int not null,
    		`userpath` text not null,
     		`lastLoginTime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
			primary key(`id`))default charset=utf8;",
		"fmdb_file"=>"CREATE TABLE IF NOT EXISTS `fmdb_file`(
			`id` int not null auto_increment,
			`fid` text not null,
			`uid` text not null,
			`path` text not null,
			`fileExt` text not null,
			`tags` text not null,
			`isStard` int not null,
			`isDeleted` int not null,
			`downloadCount` int not null,
			`isDisplayed` int not null,
			`group` text not null,
			`createTime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			primary key(`id`))default charset=utf8;",
		"fmdb_download"=>"CREATE TABLE IF NOT EXISTS `fmdb_download`(
			`id` int not null auto_increment,
			`donid` text not null,
			`fid` text not null,
			`uid` text not null,
			`downloadTime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			primary key(`id`))default charset=utf8;",
		"fmdb_stars"=>"CREATE TABLE IF NOT EXISTS `fmdb_stars`( 
			`id` int not null auto_increment, 
			`stid` text not null,
			`uid` text not null,
			`fid` text not null,
			primary key(`id`))default charset=utf8;",
		"fmdb_comments"=>"CREATE TABLE IF NOT EXISTS `fmdb_comments`(
			`id` int not null auto_increment,
			`coid` text not null,
			`fid` text not null,
			`uid` text not null,
			`content` text not null,
			`commentTime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			primary key(`id`))default charset=utf8;",
		"fmdb_workpoints"=>"CREATE TABLE IF NOT EXISTS `fmdb_workpoints`(
			`id` int not null auto_increment,
			`wpid` text not null,
			`uid` text not null,
			`fid` text not null,
			`grade` int not null,
			primary key(`id`))default charset=utf8;",
		"fmdb_group"=>"CREATE TABLE IF NOT EXISTS `fmdb_group`(
			`id` int not null auto_increment,
			`gpid` text not null,
			`groupname` text not null,
			primary key(`id`))default charset=utf8;"
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