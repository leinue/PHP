<?php

namespace Cores\Models;

class Model{

	protected $tableName;
	protected $prefix;
	static $model;

	function __construct($tableName=null){
		$this->tableName=$tableName;
		if($this->isTableNameNull()){
			return false;
		}
		$prefix=C('dbconfig');
		if($prefix['dbprefix']!=null){
			$this->prefix=$prefix['dbprefix'];
		}
		self::$model=D($this->prefix.$this->tableName);
	}

	function selectAll(){
		if($this->isTableNameNull()){
			return false;
		}

		$cataObj=self::$model->getDatabase()->query("select * from ".$this->prefix.$this->tableName,[],'Cores\\Models\\'.$this->humplize());
		return $cataObj;
	}

	function isTableNameNull(){
		return $this->tableName==null;
	}

	function humplize(){
		return hump($this->tableName);
	}

	function getRealModel(){
		$modelName='Cores\\Models\\'.$this->humplize().'Model';
		return new $modelName();
	}

}

?>