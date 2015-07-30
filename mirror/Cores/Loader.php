<?php

namespace Cores;

class Loader{

	static function autoload($class){

		echo BASEDIR.'\\'.str_replace('\\', '/', $class).'.php'.'<br>';

        require BASEDIR.'\\'.str_replace('\\', '/', $class).'.php';
	}

}

spl_autoload_register('Cores\\Loader::autoload');

require(BASEDIR.'/Cores/functions.php');
