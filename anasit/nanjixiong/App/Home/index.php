<?php
// require('App/Admin/header.php');
// require('App/Admin/sidebar.php');

define('BASEDIR_HOME',BASEDIR.'/App/Home/');
define('DOMAIN_HOME',DOMAIN.'/App/Home/');

$view=$_GET['v'];
if(empty($view)){
    redirectTo('index.php?v=home');
}

if($view=='404'){
    redirectTo(DOMAIN_HOME.'404.php');
}

$tplURI=BASEDIR_HOME.$view.'.php';

if(file_exists($tplURI)){
    require $tplURI;
}else{
    redirectTo('index.php?v=404');
}

?>
