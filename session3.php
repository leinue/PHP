<?php
session_start(); /*important!!*/
session_destroy();
setcookie(session_name(),'',time()-3600);
$_SESSION=array();
?>
