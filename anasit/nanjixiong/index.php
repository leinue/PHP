<?php

//error_reporting(E_ALL & ~E_NOTICE);


//ini_set('display_errors',1);

define('BASEDIR',__DIR__);
require(BASEDIR."/Cores/Loader.php");


session_start();;

require('./App/Home/header.php');
require('./App/Home/index.php');
require('./App/Home/footer.php');

?>
