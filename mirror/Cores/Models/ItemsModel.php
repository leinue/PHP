<?php

namespace Cores\Models;

/**
* 
*/
class ItemsModel{
	
	static $model;

	function __construct(){
		self::$model=D('njx_items');
	}

	function selectAll(){
		$cataObj=self::$model->getDatabase()->query("select * from njx_items",[],'Cores\Models\Items');
		return $cataObj;
	}
}

?>