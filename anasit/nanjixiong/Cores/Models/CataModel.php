<?php

namespace Cores\Models;

/**
* 
*/
class CataModel{

	static $model;
	
	function __construct(){
		self::$model=D('njx_cata');
	}

	function selectAll(){
		$cataObj=self::$model->getDatabase()->query("SELECT * FROM `njx_cata`",[],'Cores\Models\Cata');
		return $cataObj;
	}

	function selectOne($caid){
		return self::$model->getDatabase()->query("SELECT * FROM `njx_cata` WHERE `caid`='$caid'",[],'Cores\Models\Cata');
	}

	function getFieldChild($caid){
		$tmp=self::$model->query("SELECT `child` FROM `njx_cata` WHERE `caid`='$caid'");
		return $tmp[0]['child'];
	}

	function getFieldParent($caid){
		$tmp=self::$model->query("SELECT `parent` FROM `njx_cata` WHERE `caid`='$caid'");
		return $tmp[0]['parent'];
	}

	function getCataChild($parent_id){
		$tmp=self::$model->query("SELECT * FROM `njx_cata` WHERE `parent`='$parent_id'");
		return $tmp;
	}

	function getParent($caid){
		return self::$model->getDatabase()->query("SELECT * FROM `njx_cata` WHERE `caid`='$caid'");
	}

	function getCataByName($name){
		return self::$model->getDatabase()->query("SELECT `caid` FROM `njx_cata` WHERE `name`='$name'");
	}

	function isNameExists($name){
		$tmp=$this->getCataByName($name);
		return is_array($tmp);
	}	

	function addChild($name,$parent=null,$child=null){

		if($name==null){
			return false;
		}

		$parent=$parent==null ? '0' : $parent;
		$child=$child==null ? '0' : $child;

		if($this->isNameExists($name)){
			return -1;
		}

		$currentGuid=guid();
		
		$result=self::$model->execute("INSERT INTO `njx_cata` SET `caid`=? ,`name`=? ,`parent`=?,`child`=?",array($currentGuid,$name,$parent,$child));
		return $this->selectOne($currentGuid);
	}

	function add($name){
		return $this->addChild($name);
	}

	function isExists($caid){
		return $caid==null ? false : is_array($this->getParent($caid));
	}

	function modify($caid,$name){
		
		if($caid==null || $name ==null){
			return false;
		}

		if(!$this->isExists($caid)){
			return -1;//不存在
		}

		$result=self::$model->execute("UPDATE `njx_cata` SET `name`=? WHERE `caid`=?",array($name,$caid));
		return $result;
	}

	function delete($caid){
		
		if(!$this->isExists($caid)){
			return -1;
		}

		$thisParent=$this->getFieldParent($caid);

		if($thisParent==='0'){//父分类
			$childList=$this->getCataChild($caid);
			$this->deleteChild($childList);
		}

		$result=self::$model->execute("DELETE FROM `njx_cata` WHERE `caid`=?",array($caid));

		return $result;
	}

	function deleteChild($childList){
		if(!is_array($childList)){return false;}
		foreach ($childList as $key => $value) {
			$this->delete($value['caid']);
		}
	}

}

?>