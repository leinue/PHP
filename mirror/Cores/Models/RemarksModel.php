<?php

namespace Cores\Models;

/**
* 
*/
class RemarksModel{
	
	static $model;

	function __construct(){
		self::$model=D('njx_remarks');
	}

	function selectAll(){
		$cataObj=self::$model->getDatabase()->query("select * from njx_remarks",[],'Cores\Models\Remarks');
		return $cataObj;
	}
}

?>