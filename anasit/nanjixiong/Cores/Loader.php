<?php

namespace Cores;

date_default_timezone_set("Asia/Shanghai");

$requestURI=explode("/", $_SERVER['REQUEST_URI']);
$requestURI=$requestURI[1];

define('DOMAIN','http://'.$_SERVER['HTTP_HOST'].'/'.$requestURI);

class Loader{

	static function autoload($class){

		// echo BASEDIR.'\\'.str_replace('\\', '/', $class).'.php'.'<br>';

        require BASEDIR.'\\'.str_replace('\\', '/', $class).'.php';
	}

}

spl_autoload_register('Cores\\Loader::autoload');

require(BASEDIR.'/Cores/functions.php');

