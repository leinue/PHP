<?php

namespace Cores\Models;

/**
* 
*/
class Model{
	
	var $tableName;
	static $model;

	function __construct($tableName=null){
		self::$tableName=$tableName;
		self::$model=D($tableName);
	}
}

?>