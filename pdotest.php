<?php

try {
	$pdo=new PDO('mysql:dbname=test;host=localhost','root','xieyang');
} catch (PDOException $e) {
	echo $e->getMessage();
}

?>