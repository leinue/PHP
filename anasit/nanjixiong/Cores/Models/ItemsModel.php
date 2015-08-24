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

	function selectAll($page=null,$arr=false){
		if($page==null){
			$cataObj=self::$model->getDatabase()->query("SELECT * from `njx_items` ORDER BY `order` DESC",[],'Cores\Models\Items');
			return $cataObj;
		}else{
			if(!$arr){
				return $cataObj=self::$model->getDatabase()->query("SELECT * FROM `njx_items` ORDER BY `order` DESC LIMIT ".($page-1).",".($page+10));
			}else{
				return $cataObj=self::$model->getDatabase()->query("SELECT * FROM `njx_items` ORDER BY `order` DESC LIMIT ".($page-1).",".($page+10),[],'Cores\Models\Items');
			}
			
		}
	}

	function count(){
		return count($this->selectAll());
	}

	function selectOne($iid){
		return self::$model->getDatabase()->query("SELECT * FROM `njx_items` WHERE `iid`='$iid'",[],'Cores\Models\Items');
	}

	function add($uid,$caid,$title){
		
		if($uid==null || $caid==null || $title==null){
			return false;
		}

		$iid=guid();
		$order=$this->count()+1;
		$createTime=date('Y-m-d H:i:s',time());
		$modifyTime=$createTime;
		$isDeleted='0';
		$commentsCount='0';
		$status='0';

		self::$model->getDatabase()->execute("INSERT INTO `njx_items` SET `iid`=?,`order`=?,`createTime`=?,`modifyTime`=?,`uid`=?,`caid`=?,`isDeleted`=?,`commentsCount`=?,`status`=?,`title`=?",array($iid,$order,$createTime,$modifyTime,$uid,$caid,$isDeleted,$commentsCount,$status,$title));
		return $this->selectOne($iid);
	}

	function delete($iid){
		
		if($iid==null){
			return false;
		}

		return self::$model->getDatabase()->execute("DELETE FROM `njx_items` WHERE `iid`=?",array($iid));
	}

	function approve($iid){
		
		if($iid==null){
			return false;
		}

		return self::$model->getDatabase()->query("UPDATE `njx_items` SET `status`=1 WHERE `iid`='$iid'");
	}

	function reject($iid){
		
		if($iid==null){
			return false;
		}

		return self::$model->getDatabase()->query("UPDATE `njx_items` SET `status`=0 WHERE `iid`='$iid'");

	}

	function getMaxOrder($iid){

		if($iid==null){
			return false;
		}

		return self::$model->getDatabase()->query("SELECT MAX(`order`) AS max_order,`iid` FROM `njx_items`");
	}

	function getSecondOrder($iid){
		if($iid==null){
			return false;
		}

		$max=$this->getMaxOrder($iid);

		return self::$model->getDatabase()->query("SELECT `order` AS `2nd_order` FROM `njx_items` WHERE `2nd_order` < $max");
	}

	function getOrder($iid){

		if($iid=null){
			return false;
		}

		return self::$model->getDatabase()->query("SELECT `order` FROM `njx_items` WHERE `iid`='$iid'");
	}

	function getUserItem($uid){
		return self::$model->getDatabase()->query("SELECT * FROM `njx_items` WHERE `uid`='$uid'");
	}

	function upOrder($iid){

		if($iid==null){
			return false;
		}

		$maxOrder=$this->getMaxOrder($iid);
		$maxOrder=$maxOrder[0]['max_order'];
		// $itemsCount=$this->count();
		$myOrder=$this->selectOne($iid);
		$myOrder=$myOrder[0]->getOrder();

		$realOrder=0;

		if($myOrder==$maxOrder){
			$myOrder++;
		}

		if($myOrder<$maxOrder){
			$myOrder=$maxOrder+1;
		}

		$realOrder=$myOrder;

		return self::$model->getDatabase()->execute("UPDATE `njx_items` SET `order`=$realOrder WHERE `iid`='$iid'");

	}

	function downOrder($iid){

		if($iid==null){
			return false;
		}

		$myOrder=$this->selectOne($iid);
		$myOrder=$myOrder[0]->getOrder();

		$realOrder=$myOrder-2;

		return self::$model->getDatabase()->execute("UPDATE `njx_items` SET `order`=$realOrder WHERE `iid`='$iid'");

	}

	function getTop5(){
		return self::$model->getDatabase()->query("SELECT * FROM `njx_items` ORDER BY `commentsCount` LIMIT 5");
	}

	function modify($iid,$caid,$title){

		if($iid==null || $caid==null || $title==null){
			return false;
		}

		return self::$model->getDatabase()->execute("UPDATE `njx_items` SET `caid`=?, `title`=? WHERE `iid`=?",array($caid,$title,$iid));
	}
}

?>