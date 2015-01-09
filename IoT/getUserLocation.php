<?php
require('mysql/usemysql.php');

try {
	$pdo=new PDO("mysql:host=localhost;dbname=ncu",$user,$password);
} catch (PDOException $e) {
	echo $e->getMessage();
}

$lm=new locationManager($pdo);
$all=$lm->getAll();

$newest=0;

$lat=$all[count($all)-1]->getLat();
$long=$all[count($all)-1]->getLong();
header('location:req.php?latitude='.$lat.'&longitude='.$long);
?>