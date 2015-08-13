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

	function selectAll($page=null){
		if($page==null){
			$cataObj=self::$model->getDatabase()->query("SELECT * FROM njx_users",[],'Cores\Models\Users');
			return $cataObj;
		}else{
			return self::$model->getDatabase()->query("SELECT * FROM `njx_users` ORDER BY `privilege` LIMIT ".($page-1).','.($page+10));
		}
	}

	function selectOne($uid){
		return self::$model->getDatabase()->query("SELECT * FROM `njx_users` WHERE `uid`='$uid'",[],'Cores\Models\Users');
	}

	function add($discuzId,$name,$privilege){
		
		if($discuzId==null || $name==null || $privilege==null){
			return false;
		}

		$uid=guid();
		$createTime=date('H-m-d H:i:s',time());
		self::$model->getDatabase()->execute("INSERT INTO `njx_users` SET `uid`=?,`discuzId`=?,`createTime`=?,`name`=?,`privilege`=?",array($uid,$discuzId,$createTime,$name,$privilege));
		return $this->selectOne($uid);
	}

	function delete($uid){
		
		if($uid==null){
			return false;
		}

		return self::$model->getDatabase()->execute("DELETE FROM `njx_users` WHERE `uid`=?",array($uid));

	}

	function block($uid){
		
		if($uid==null){
			return false;
		}

		return self::$model->getDatabase()->execute("UPDATE `njx_users` SET `privilege`=9 WHERE `uid`=?",array($uid));

	}

	function deblock($uid){

		if($uid==null){
			return false;
		}

		return self::$model->getDatabase()->execute("UPDATE `njx_users` SET `privilege`=127 WHERE `uid`=?",array($uid));

	}

	function getUserItem($uid){
		$itemObj=new ItemsModel();
		return $itemObj->getUserItem($uid);
	}

	// function modify($oid,$value){

	// 	if($oid==null || $value==null){
	// 		return false;
	// 	}

	// 	return self::$model->getDatabase()->execute("UPDATE `njx_users` SET `value`=? WHERE `oid`=?",array($value,$oid));
	// }

}

?>