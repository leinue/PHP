<?php

namespace Cores\Models;

/**
* 
*/
class CataModel{

	static $model;
	
	function __construct(){
		self::$model=D('njx_cata');
	}

	function selectAll(){
		$cataObj=self::$model->getDatabase()->query("select * from njx_cata",[],'Cores\Models\Cata');
		return $cataObj;
	}

	
}

?>