<?php

namespace Cores;

class Databases{

	protected static $instance;
	protected static $databaseObj;
	protected static $sql;

	static function CreateDatabase($dbconfig){

		if(self::$instance instanceof self){
			return self::$instance;
		}else{
			$dbtype=$dbconfig['dbtype'];
			$dbtype='Cores\\Databases\\'.$dbtype;
			self::$databaseObj=new $dbtype($dbconfig);
			self::$instance=new self;
			return self::$instance;
		}

	}

	function query($sql=null){
		return self::$databaseObj->query($sql);
	}

	function execute($sql=null){
		return self::$databaseObj->execute($sql);
	}

	function update(){
		return self::$instance;
	}

	function delete(){
		return self::$instance;
	}

	function insert(){
		return self::$instance;
	}

	function select(){
		return self::$instance;
	}

	function find($id){
		return self::$instance;
	}

	function where(){
		return self::$instance;
	}

	function limit(){
		return self::$instance;
	}

	function page(){
		return self::$instance;
	}

	function order(){
		return self::$instance;
	}

	function getDatabase(){
		return self::$databaseObj;
	}

}