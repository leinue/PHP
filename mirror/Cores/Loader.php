<?php

namespace Cores;

class Loader{

	static function autoload($class){
        require BASEDIR.'\\'.str_replace('\\', '/', $class).'.php';
	}

}

spl_autoload_register('Cores\\Loader::autoload');

require(BASEDIR.'/Cores/functions.php');
