<?php

namespace Cores\Models;

/**
* 
*/
class FieldsModel{
	
	static $model;
	
	function __construct(){
		self::$model=D('njx_fields');
	}

	function selectAll(){
		$cataObj=self::$model->getDatabase()->query("select * from njx_fields",[],'Cores\Models\Fields');
		return $cataObj;
	}
}

?>