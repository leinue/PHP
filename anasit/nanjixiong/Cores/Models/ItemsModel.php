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

	function selectAll($page=null){
		if($page==null){
			$cataObj=self::$model->getDatabase()->query("SELECT * from `njx_items`",[],'Cores\Models\Items');
			return $cataObj;
		}else{
			return $cataObj=self::$model->getDatabase()->query("SELECT * FROM `njx_items` LIMIT $page,".($page+10));
		}
	}

	function count(){
		return count($this->selectAll());
	}

	function selectOne($iid){
		return self::$model->getDatabase()->query("SELECT * FROM `njx_items` WHERE `iid`='$iid'",[],'Cores\Models\Items');
	}

	function add($uid,$caid){
		
		if($uid=null || $caid=null){
			return false;
		}

		$iid=guid();
		$order=$this->count()+1;
		$createTime=date('Y-m-d H:i:s',time());
		$modifyTime=$createTime;
		$isDeleted='0';
		$commentsCount='0';
		$status='0';

		self::$model->getDatabase()->execute("INSERT INTO `njx_items` SET `iid`=?,`order`=?,`createTime`=?,`modifyTime`=?,`uid`=?,`caid`=?,`isDeleted`=?,`commentsCount`=?,`status`=?",array($iid,$order,$createTime,$modifyTime,$uid,$caid,$isDeleted,$commentsCount,$status));
		return $this->selectOne($iid);
	}

	function delete($iid){
		
		if($iid==null){
			return false;
		}

		return self::$model->getDatabase()->execute("DELETE FROM `njx_items` WHERE `iid`=?",array($iid));
	}

	// function modify($iid,$value){

	// 	if($oid==null || $value==null){
	// 		return false;
	// 	}

	// 	return self::$model->getDatabase()->execute("UPDATE `njx_items` SET `value`=? WHERE `oid`=?",array($value,$oid));
	// }
}

?>