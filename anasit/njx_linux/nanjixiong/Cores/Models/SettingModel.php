<?php

namespace Cores\Models;

class SettingModel{
	
	static $model;

	function __construct(){
		self::$model=D('njx_setting');
	}

	function selectAll($page=null){
		if($page==null){
			$cataObj=self::$model->getDatabase()->query("SELECT * FROM `njx_setting`",[],'Cores\Models\Setting');
			return $cataObj;
		}else{
			return self::$model->getDatabase()->query("SELECT * FROM `njx_setting` LIMIT ".(($page-1)*10).',10',[],'Cores\Models\Setting');
		}
	}

	function selectOne($sid){
		return self::$model->getDatabase()->query("SELECT * FROM `njx_setting` WHERE `sid`='$sid'",[],'Cores\Models\Setting');
	}

	function add($name,$value){
		
		if($name==null || $value==null){
			return false;
		}

		$sid=guid();
		self::$model->getDatabase()->execute("INSERT INTO `njx_setting` SET `sid`=?,`name`=?,`value`=?",array($sid,$name,$value));
		return $this->selectOne($sid);
	}

	function delete($sid){
		
		if($sid==null){
			return false;
		}

		return self::$model->getDatabase()->execute("DELETE FROM `njx_setting` WHERE `sid`=?",array($sid));

	}

	function modify($sid,$name,$value){

		if($sid==null || $name==null || $value==null){
			return false;
		}

		return self::$model->getDatabase()->execute("UPDATE `njx_setting` SET `name`=?,`value`=? WHERE `sid`=?",array($name,$value,$sid));
	}

	function get($key){
		$all=$this->selectAll();
		foreach ($all as $k => $value) {
			if($value->getName()==$key){
				return $value->getValue();
			}
		}
	}

	function set($key,$value){
		$all=$this->selectAll();
		foreach ($all as $k => $v){
			if($v->getName()==$key){
				$this->modify($v->getSid(),$key,$value);
			}
		}
	}
}

?>
