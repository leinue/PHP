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

	function selectAll($page=null){
		if($page==null){
			$cataObj=self::$model->getDatabase()->query("select * from `njx_remarks`",[],'Cores\Models\Remarks');
			return $cataObj;
		}else{
			return self::$model->getDatabase()->query("SELECT * FROM `njx_remarks` LIMIT ".($page-1).','.($page+10),[],'Cores\Models\Remarks');
		}
	}

	function selectOne($remarkId){
		return self::$model->getDatabase()->query("SELECT * FROM `njx_remarks` WHERE `remarkId`='$remarkId'",[],'Cores\Models\Remarks');
	}

	function add($points,$itemId){
		
		if($points==null || $itemId==null){
			return false;
		}

		$one=$this->selectOne($itemId);
		
		$remarkId=guid();
		self::$model->getDatabase()->execute("INSERT INTO `njx_remarks` SET `remarkId`=?,`points`=?,`itemId`=?",array($remarkId,$points,$itemId));
		return $this->selectOne($remarkId);
	}

	function delete($remarkId){
		
		if($remarkId==null){
			return false;
		}

		return self::$model->getDatabase()->execute("DELETE FROM `njx_remarks` WHERE `remarkId`=?",array($remarkId));

	}

	function modify($remarkId,$points){

		if($remarkId==null || $points==null){
			return false;
		}

		return self::$model->getDatabase()->execute("UPDATE `njx_remarks` SET `points`=? WHERE `remarkId`=?",array($points,$remarkId));
	}
}

?>