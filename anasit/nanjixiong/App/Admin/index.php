<?php
// require('App/Admin/header.php');
// require('App/Admin/sidebar.php');

define('BASEDIR_ADMIN',BASEDIR.'/App/Admin/');
define('DOMAIN_ADMIN',DOMAIN.'/App/Admin/');

$view=$_GET['v'];
if(empty($view)){
    redirectTo('admin.php?v=home');
}

if($view=='404'){
    redirectTo(DOMAIN_ADMIN.'404.php');
}

$tplURI=BASEDIR_ADMIN.$view.'.php';

if(file_exists($tplURI)){
    require $tplURI;
}else{
    redirectTo('admin.php?v=404');
}

?>
