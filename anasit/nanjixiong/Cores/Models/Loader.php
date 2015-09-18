<?php

namespace Cores;

date_default_timezone_set("Asia/Shanghai");

$requestURI=explode("/", $_SERVER['REQUEST_URI']);


$requestURI=$requestURI[1];


define('DOMAIN','http://'.$_SERVER['HTTP_HOST']);



class Loader{

	static function autoload($class){	
		$class=str_replace("\\",'/',$class.'.php');
		$prefix= BASEDIR.'/'.$class;
        	include $prefix;
	}

}

spl_autoload_register('Cores\\Loader::autoload');

require(BASEDIR.'/Cores/functions.php');

