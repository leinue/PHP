<?php

namespace Cores\Models;

/**
* 
*/
class FieldsOptionsModel{
	
	static $model;
	
	function __construct(){
		self::$model=D('njx_fields_options');
	}

	function selectAll(){
		$cataObj=self::$model->getDatabase()->query("select * from njx_fields_options",[],'Cores\Models\FieldsOptions');
		return $cataObj;
	}

	function selectOne($foid){
		return self::$model->getDatabase()->query("SELECT * FROM `njx_fields_options` WHERE `foid`='$foid'",[],'Cores\Models\FieldsOptions');
	}

	function add($name,$type,$tips=null,$selectorCount=null,$rangeFrom=null,$rangeTo=null,$rangeUnit=null){

		if($name==null || $type==null){
			return false;
		}

		$foid=guid();
		self::$model->getDatabase()->execute("INSERT INTO `njx_fields_options` SET `foid`=?,`name`=?,`tips`=?,`type`=?,`selectorCount`=?,`rangeFrom`=?,`rangeTo`=?,`rangeUnit`=?",array($foid,$name,$tips,$type,$selectorCount,$rangeFrom,$rangeTo,$rangeUnit));
		return $this->selectOne($foid);
	}

	function delete($foid){
		if($foid==null){
			return false;
		}

		return self::$model->getDatabase()->execute("DELETE FROM `njx_fields_options` WHERE `foid`=?",array($foid));
	}

	function modify($foid,$name,$type,$tips=null,$selectorCount=null,$rangeFrom=null,$rangeTo=null,$rangeUnit=null){

		if($foid==null || $name==null || $type==null){
			return false;
		}

		return self::$model->getDatabase()->execute("UPDATE `njx_fields_options` SET `name`=?,`tips`=?,`type`=?,`selectorCount`=?,`rangeFrom`=?,`rangeTo`=?,`rangeUnit`=? WHERE `foid`=?",array($name,$tips,$type,$selectorCount,$rangeFrom,$rangeTo,$rangeUnit,$foid));

	}

	function setVisible($foid){
		return self::$model->getDatabase()->execute("UPDATE `njx_fields_options` SET `visible`=? WHERE `foid`=?",array('1',$foid));
	}

	function setNoVisible($foid){
		return self::$model->getDatabase()->execute("UPDATE `njx_fields_options` SET `visible`=? WHERE `foid`=?",array('0',$foid));
	}

	function getFieldFrontPhoto(){
		return self::$model->getDatabase()->query("SELECT * FROM `njx_fields_options` WHERE `isPhoto`=1");
	}

	function getFieldDesc(){
		return self::$model->getDatabase()->query("SELECT * FROM `njx_fields_options` WHERE `isDesc`=1");
	}

	function modifyFieldFrontPhoto($foid,$value){
		return self::$model->getDatabase()->execute("UPDATE `njx_fields_options` SET `isPhoto`=? WHERE `foid`=?",array($value,$foid));
	}

	function modifyFieldFrontDesc($foid,$value){
		return self::$model->getDatabase()->execute("UPDATE `njx_fields_options` SET `isDesc`=? WHERE `foid`=?",array($value,$foid));
	}

	function setAsFrontPhoto($foid){
		$currentField=$this->getFieldFrontPhoto();
		$id=$currentField[0]['foid'];
		$this->modifyFieldFrontPhoto($id,0);
		$this->modifyFieldFrontPhoto($foid,1);
	}

	function setAsFrontDesc($foid){
		$currentField=$this->getFieldDesc();
		$id=$currentField[0]['foid'];
		$this->modifyFieldFrontDesc($id,0);
		$this->modifyFieldFrontDesc($foid,1);
	}

}

?>