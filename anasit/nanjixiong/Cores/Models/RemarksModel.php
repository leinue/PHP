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

	function selectOne($remarkId){
		return self::$model->getDatabase()->query("SELECT * FROM `njx_remarks` WHERE `remarkId`='$remarkId'",[],'Cores\Models\Remarks');
	}

	function add($points,$itemId){
		
		if($points==null || $itemId==null){
			return false;
		}

		$remarkId=guid();
		self::$model->getDatabase()->execute("INSERT INTO `njx_remarks` SET `remarkId`=?,`points`=?,`itemId`=?",array($remarkId,$points,$ite=]mId));
		return $this->selectOne($remarkId);
	}

	function delete($remarkId){
		
		if($remarkId==null){
			return false;
		}

		return self::$model->getDatabase()->execute("DELETE FROM `njx_remarks` WHERE `oid`=?",array($remarkId));

	}

	function modify($remarkId,$points){

		if($remarkId==null || $points==null){
			return false;
		}

		return self::$model->getDatabase()->execute("UPDATE `njx_remarks` SET `remarkId`=? WHERE `points`=?",array($remarkId,$points));
	}
}

?>