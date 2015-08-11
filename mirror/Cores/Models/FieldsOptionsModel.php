<?php

namespace Cores\Models;

/**
* 
*/
class FieldsOptionsModel{
	
	static $model;
	
	function __construct(){
		self::$model=D('njx_fields_options');
	}

	function selectAll(){
		$cataObj=self::$model->getDatabase()->query("select * from njx_fields_options",[],'Cores\Models\FieldsOptions');
		return $cataObj;
	}
}

?>