<?php
session_start();
$_SESSION['current_file_count']=20;
echo '['.json_encode($_SESSION['current_file_count']).']';
?>