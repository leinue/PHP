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
		return self::$model->getDatabase()->query("SELECT * FROM njx_fields",[],'Cores\Models\Fields');
	}

	function selectOne($oid){
		return self::$model->getDatabase()->query("SELECT * FROM `njx_fields` WHERE `oid`='$oid'",[],'Cores\Models\Fields');
	}

	function getByItemId($itemId){
		if($itemId==null){
			return false;
		}
		return self::$model->getDatabase()->query("SELECT * FROM `njx_fields` WHERE `itemId`='$itemId'");
	}

	function add($foid,$value,$itemId){
		
		if($foid==null || $value==null || $itemId==null){
			return false;
		}

		$oid=guid();
		self::$model->getDatabase()->execute("INSERT INTO `njx_fields` SET `oid`=?,`foid`=?,`value`=?,`itemId`=?",array($oid,$foid,$value,$itemId));
		return $this->selectOne($oid);
	}

	function delete($oid){
		
		if($oid==null){
			return false;
		}

		return self::$model->getDatabase()->execute("DELETE FROM `njx_fields` WHERE `oid`=?",array($oid));

	}

	function modify($oid,$value){

		if($oid==null || $value==null){
			return false;
		}

		return self::$model->getDatabase()->execute("UPDATE `njx_fields` SET `value`=? WHERE `oid`=?",array($value,$oid));
	}

}

?>