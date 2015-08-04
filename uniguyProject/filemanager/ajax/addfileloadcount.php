<?php
session_start();

if(isset($_GET['page'])){
	$_SESSION['current_file_count']=$_GET['page']*$_SESSION['file_load_step'];
}else{
	$_SESSION['current_file_count']+=$_SESSION['file_load_step'];
	echo '['.json_encode($_SESSION['current_file_count']).']';
}

?>