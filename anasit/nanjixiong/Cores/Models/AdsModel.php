<?php

namespace Cores\Models;

class AdsModel{
	
	static $model;

	function __construct(){
		self::$model=D('njx_ads');
	}

	function selectAll($page=null){
		if($page==null){
			$cataObj=self::$model->getDatabase()->query("select * from `njx_ads`",[],'Cores\Models\Ads');
			return $cataObj;
		}else{
			return self::$model->getDatabase()->query("SELECT * FROM `njx_ads` LIMIT ".($page-1).','.($page+10),[],'Cores\Models\Ads');
		}
	}

	function selectOne($aid){
		return self::$model->getDatabase()->query("SELECT * FROM `njx_ads` WHERE `aid`='$aid'",[],'Cores\Models\Ads');
	}

	function add($content,$image,$url){
		
		if($content==null || $image==null || $url=null){
			return false;
		}

		$aid=guid();
		$display=1;
		self::$model->getDatabase()->execute("INSERT INTO `njx_ads` SET `aid`=?,`content`=?,`image`=?,`url`=?,`display`=?",array($aid,$content,$image,$url,$display));
		return $this->selectOne($aid);
	}

	function delete($aid){
		
		if($aid==null){
			return false;
		}

		return self::$model->getDatabase()->execute("DELETE FROM `njx_ads` WHERE `aid`=?",array($aid));

	}

	function modify($aid,$content,$image,$url){

		if($aid==null || $content==null || $image==null || $url==null){
			return false;
		}

		return self::$model->getDatabase()->execute("UPDATE `njx_ads` SET `content`=?,`image`=?,`url`=? WHERE `aid`=?",array($content,$image,$url,$aid));
	}

	function setDisplay($aid){
		
		if($aid==null){
			return false;
		}

		return self::$model->getDatabase()->execute("UPDATE `njx_ads` SET `display`=1 WHERE `aid`=$aid");

	}

	function setNoDisplay($aid){

		if($aid==null){
			return false;
		}

		return self::$model->getDatabase()->execute("UPDATE `njx_ads` SET `display`=0 WHERE `aid`=$aid");

	}
}

?>
