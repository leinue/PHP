<?php

try {
	$pdo=new PDO('mysql:dbname=test;host=localhost','root','xieyang');
	$sql="SELECT * FROM `sessions` ";
	$res=$pdo->query($sql);
	//$res->setFetchMode(PDO::FETCH_NUM);
	while ($row=$res->fetch()) {
		echo $row[1];
	}
} catch (PDOException $e) {
	echo $e->getMessage();
}

/*
预定义语句

$sql="INSERT INTO `tasks` (paren_id,pw) VALUES(:parent_id,:pw)";
$stmt=$pdo->prepare($sql);

$stmt->excute(array(':parent_id'=>1));

*/

?>