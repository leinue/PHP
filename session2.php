<?php
session_start();

if(isset($_SESSION['admin'])){
	echo 'welcome';
	echo "<a href='session3.php'>delete</a>";
	die();
}
else
{
	echo 'sorry';
}

?>