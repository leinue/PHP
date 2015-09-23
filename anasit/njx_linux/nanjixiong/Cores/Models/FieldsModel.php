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
		return self::$model->getDatabase()->query("SELECT * FROM `njx_fields` WHERE `itemId`='$itemId' ORDER BY `_order` DESC");
	}

	function add($foid,$value,$itemId){
		
		if($foid==null || $value==null || $itemId==null){
			return false;
		}

		// alert($value);

		$oid=guid();
		$fieldOptionsModel=new FieldsOptionsModel();
		$orderObj=$fieldOptionsModel->selectOne($foid);
		$order=$orderObj[0]->getOrder() === null ? 0 : $orderObj[0]->getOrder();
		self::$model->getDatabase()->execute("INSERT INTO `njx_fields` SET `oid`=?,`foid`=?,`value`=?,`itemId`=?,`_order`=?",array($oid,$foid,$value,$itemId,$order));
		$result = $this->selectOne($oid);
		return $result;
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
		$result=self::$model->getDatabase()->execute("UPDATE `njx_fields` SET `value`='$value' WHERE `oid`='$oid'");
		return $result;
	}

}

?>
