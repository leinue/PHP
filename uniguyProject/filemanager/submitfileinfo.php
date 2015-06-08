<?php

require('mysql/sql.php');

$title=$_POST['title'];
$author=$_POST['author'];
$tags=$_POST['tags'];
$description=$_POST['description'];
$path=$_POST['path'];

if(isset($title) && isset($author) && isset($tags) && isset($description) && isset($path)){
	$pdo=new PDO("mysql:dbname=$dbname;host=$host",'doc','doc');
	$fm=new fileMgr($pdo);
	$fm->submitFileInfo($title,$author,$tags,$description,$path);
	echo '完善成功';
}else{
	echo '请完整填写信息';
}

?>
