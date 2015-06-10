<?php
session_start();
$_SESSION['current_file_count']+=$_SESSION['file_load_step'];
echo '['.json_encode($_SESSION['current_file_count']).']';
?>