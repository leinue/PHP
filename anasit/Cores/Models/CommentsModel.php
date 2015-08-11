<?php

namespace Cores\Models;

/**
* 
*/
class CommentsModel{

	static $model;
	
	function __construct(){
		self::$model=D('njx_comments');
	}

	function selectAll(){
		$cataObj=self::$model->getDatabase()->query("select * from njx_comments",[],'Cores\Models\Comments');
		return $cataObj;
	}

	
}

?>