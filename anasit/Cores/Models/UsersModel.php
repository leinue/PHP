<?php

namespace Cores\Models;

/**
* 
*/
class UsersModel{
	
	static $model;

	function __construct(){
		self::$model=D('njx_users');
	}

	function selectAll(){
		$cataObj=self::$model->getDatabase()->query("select * from njx_users",[],'Cores\Models\Users');
		return $cataObj;
	}
}

?>