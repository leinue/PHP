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

	function selectAll($arr=false){
		if(!$arr){
			return self::$model->getDatabase()->query("SELECT * FROM `njx_cata` ORDER BY `order` DESC",[],'Cores\Models\Cata');
		}else{
			return self::$model->getDatabase()->query("SELECT * FROM `njx_cata` ORDER BY `order` DESC",[]);
		}
	}

	function selectOne($caid,$arr=false){
		if($arr){
			return self::$model->getDatabase()->query("SELECT * FROM `njx_cata` WHERE `caid`='$caid'",[]);
		}else{
			return self::$model->getDatabase()->query("SELECT * FROM `njx_cata` WHERE `caid`='$caid'",[],'Cores\Models\Cata');
		}
	}

	function select1stLevelCata(){
		return self::$model->getDatabase()->query("SELECT * FROM `njx_cata` WHERE `parent`='0'");
	}

	function getFieldChild($caid){
		$tmp=self::$model->query("SELECT `child` FROM `njx_cata` WHERE `caid`='$caid' ORDER BY `order` DESC");
		return $tmp[0]['child'];
	}

	function getFieldParent($caid){
		$tmp=self::$model->query("SELECT `parent` FROM `njx_cata` WHERE `caid`='$caid' ORDER BY `order` DESC");
		return $tmp[0]['parent'];
	}

	function getCataChild($parent_id){
		$tmp=self::$model->query("SELECT * FROM `njx_cata` WHERE `parent`='$parent_id' ORDER BY `order` DESC");
		return $tmp;
	}

	function getParent($caid){
		return self::$model->getDatabase()->query("SELECT * FROM `njx_cata` WHERE `caid`='$caid' ORDER BY `order` DESC");
	}

	function getParentBy2ndLvl($caid){
		$prev=$this->getParent($caid);
		$prevId=$prev[0]['parent'];
		return $prevId;
	}

	function setChild($caid,$value){
		return self::$model->execute("UPDATE `njx_cata` SET `child`=? WHERE `caid`=?",array($value,$caid));
	}

	function addSecondLevelChild($name,$parent){
		$childAdded=$this->addChild($name,$parent,null,false);
		$this->setChild($childAdded[0]->getCaid(),'second');
		return $this->selectOne($childAdded[0]->getCaid(),true);
	}

	function editSecondLevel($caid,$value){
		
		if($caid==null || $value==null){
			return false;
		}

		return self::$model->execute("UPDATE `njx_cata` SET `name`=? WHERE `caid`=?",array($value,$caid));
	}

	function getSecondLevel($parent,$arr=false){
		$allObj=$this->selectAll(false);
		$childList=array();

		if(!is_array($allObj)){
			return false;
		}

		foreach ($allObj as $key => $value) {
			$valueChild=$value->getChild();
			$valueParent=$value->getParent();
			if($valueChild=='second' && $valueParent==$parent){
				array_push($childList,$value);
			}
		}

		$newChildList=array();
		$tmp=array();

		if($arr){
			foreach ($childList as $key => $value) {
				$tmp['caid']=$value->getCaid();
				$tmp['name']=$value->getName();
				$tmp['parent']=$value->getParent();
				$tmp['child']=$value->getChild();
				array_push($newChildList, $tmp);
				$tmp=array();
			}
		}
		return $newChildList;
	}

	function addSecond($name,$parent=null){

		$parent=$parent==null?9:$parent;

		return $this->addChild($name,$parent,'second',true);
	}

	function getSecond(){
		return self::$model->getDatabase()->query("SELECT * FROM `njx_cata` WHERE `child`='second' ORDER BY `order` DESC");
	}

	function getCataByName($name){
		return self::$model->getDatabase()->query("SELECT `caid` FROM `njx_cata` WHERE `name`='$name' ORDER BY `order` DESC");
	}

	function isNameExists($name){
		$tmp=$this->getCataByName($name);
		return is_array($tmp);
	}


	function searchItemListByCaid($caid,$parent,$page=1){
		
		if($caid==null){
			return false;
		}

		return self::$model->getDatabase()->query("SELECT * FROM  `njx_items` WHERE `caid` LIKE '%$caid%' AND `caid` LIKE '%$parent%' ORDER BY `order` DESC LIMIT ".(($page-1)*10).",10");
	}

	function getSearchCount($caid,$parent){

		if($caid == null){return false;}
		
		return self::$model->getDatabase()->query("SELECT COUNT(*) FROM `njx_items` WHERE `caid` LIKE '%$caid%' AND `caid` LIKE '%$parent%'");

	}

	function addChild($name,$parent=null,$child=null,$arr=false){

		if($name==null){
			return false;
		}

		$parent=$parent==null ? '0' : $parent;
		$child=$child==null ? '0' : $child;

		// if($this->isNameExists($name)){
		// 	return -1;
		// }

		$currentGuid=guid();
		
		$result=self::$model->execute("INSERT INTO `njx_cata` SET `caid`=? ,`name`=? ,`parent`=?,`child`=?,`visible`=1",array($currentGuid,$name,$parent,$child));
		return $this->selectOne($currentGuid,$arr);
	}

	function add($name){
		return $this->addChild($name);
	}

	function isExists($caid){
		return $caid==null ? false : is_array($this->getParent($caid));
	}

	function modify($caid,$name){

		if($caid==null || $name==null){
			return false;
		}

		if(!$this->isExists($caid)){
			return -1;//不存在
		}

		$result=self::$model->execute("UPDATE `njx_cata` SET `name`=? WHERE `caid`=?",array($name,$caid));
		return $result;
	}

	function modifyParent($caid,$parent){
		
		if($caid==null || $parent==null){
			return false;
		}

		return self::$model->execute("UPDATE `njx_cata` SET `parent`=? WHERE `caid`=?",array($parent,$caid));

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
			return $this->delete($value['caid']);
		}
	}

	function setVisible($caid){
		if($caid==null){
			return false;
		}
		return self::$model->getDatabase()->execute("UPDATE `njx_cata` SET `visible`=1 WHERE `caid`=?",array($caid));
	}

	function setNoVisible($caid){
		if($caid==null){
			return false;
		}
		return self::$model->getDatabase()->execute("UPDATE `njx_cata` SET `visible`=0 WHERE `caid`=?",array($caid));
	}

	function setNoFVisible($caid){
		if($caid==null){
			return false;
		}
		return self::$model->getDatabase()->execute("UPDATE `njx_cata` SET `fvisible`=0 WHERE `caid`=?",array($caid));

	}

	function setFVisible($caid){
		if($caid==null){
			return false;
		}
		return self::$model->getDatabase()->execute("UPDATE `njx_cata` SET `fvisible`=1 WHERE `caid`=?",array($caid));
	}

	function getOrder($caid){

		if($caid==null){
			return false;
		}

		return self::$model->getDatabase()->query("SELECT `order` FROM `njx_cata` WHERE `caid`='$caid'");
	}

	function setOrder($caid,$order){

		if($caid==null || $order==null){
			return false;
		}

		return self::$model->getDatabase()->execute("UPDATE `njx_cata` SET `order`=? WHERE `caid`=?",array($order,$caid));

	}

	function getMaxOrder(){
		return self::$model->getDatabase()->query("SELECT MAX(`order`) AS `max_order` FROM `njx_cata`");
	}

	function upCata($caid){

		if($caid==null){
			return false;
		}

		$maxOrder=$this->getMaxOrder();
		$maxOrder=$maxOrder[0]['max_order'];

		$thisOrder=$this->getOrder($caid);
		$thisOrder=$thisOrder[0]['order'];

		$orderToSet=$maxOrder+1;

		return self::$model->getDatabase()->execute("UPDATE `njx_cata` SET `order`=$orderToSet WHERE `caid`='$caid'");
	}

	function downCata($caid){
		
		if($caid==null){
			return null;
		}

		$thisOrder=$this->getOrder($caid);
		$thisOrder=$thisOrder[0]['order']-1;

		return self::$model->getDatabase()->execute("UPDATE `njx_cata` SET `order`=$thisOrder WHERE `caid`='$caid'");

	}

	function setMChoice($caid,$value='1'){

		if($caid==null || $value==null){
			return false;
		}

		return self::$model->getDatabase()->execute("UPDATE `njx_cata` SET `mChoice`=$value WHERE `caid`='$caid'");
	}

	function getMChoice($caid){
		if($caid==null){
			return false;
		}

		return self::$model->getDatabase()->query("SELECT `mChoice` FROM `njx_cata` WHERE `caid`='$caid'");
	}

}

?>
