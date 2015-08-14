<?php

error_reporting(E_ALL & ~E_NOTICE);

define('BASEDIR',__DIR__);
require(BASEDIR.'/Cores/Loader.php');

require('App/Admin/header.php');
require('App/Admin/sidebar.php');
require('App/Admin/index.php');
require('App/Admin/footer.php');

?>
