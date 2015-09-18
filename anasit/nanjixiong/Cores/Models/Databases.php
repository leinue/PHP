<?php

namespace Cores;

class Databases{

	protected static $instance;
	protected static $databaseObj;
	protected $sql;
	protected static $table;

	static function CreateDatabase($dbconfig,$table=null){

		if(self::$instance instanceof self){
			return self::$instance;
		}else{
			self::$table=$table;
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

	function execute($sql=null,$arr=null,$class=null){
		return self::$databaseObj->execute($sql,$arr,$class);
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

	function select($field=null){
		$field=$field==null?'*':$field;
		$this->sql="select ".$field." from `".self::$table.'` '.$this->sql;
		return $this->query($this->sql);
	}

	function find($id){
		return self::$instance;
	}

	function where($where=null){
		$whereSQL='';
		if(is_array($where)){
			
			if(isset($where['table'])){
				self::$table=$where['table'];
			}
			$conCount=count($where);
			$index=0;
			foreach ($where as $key => $value) {
				
				if($key=='table'){continue;}

				if(!is_numeric($value)){
					$value="'$value'";
				}

				$whereSQL.=" `$key`=$value ";
				if($index!=$conCount-2){
					$whereSQL.='and ';
				}

				$index++;
			
			}
		}else{
			$whereSQL=$where;
		}
		if(is_null($whereSQL)){
			$this->sql.='';

		}else{
			$this->sql.=' where '." $whereSQL";
		}
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

	function getSQL(){
		return $this->sql;
	}

}
