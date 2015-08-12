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
		return self::$model->getDatabase()->query("select * from njx_comments",[],'Cores\Models\Comments');
	}


	function selectOne($rid){
		return self::$model->getDatabase()->query("SELECT * FROM `njx_comments` WHERE `rid`='$rid'",[],'Cores\Models\Comments');
	}

	function add($itemId,$content){
		
		if($itemId==null || $content==null){
			return false;
		}

		$rid=guid();
		$currentTime=date('Y-m-d H:i:s', time());
		echo $currentTime;
		self::$model->getDatabase()->execute("INSERT INTO `njx_comments` SET `rid`=?,`itemId`=?,`content`=?,`createTime`=?",array($rid,$itemId,$content,$currentTime));
		return $this->selectOne($rid);
	}

	function delete($rid){
		
		if($rid==null){
			return false;
		}

		return self::$model->getDatabase()->execute("DELETE FROM `njx_comments` WHERE `rid`=?",array($rid));

	}

	function modify($rid,$content){

		if($rid==null || $content==null){
			return false;
		}

		return self::$model->getDatabase()->execute("UPDATE `njx_comments` SET `content`=? WHERE `rid`=?",array($content,$rid));
	}

}

?>