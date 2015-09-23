<?php

namespace Cores\Databases;

class PDO implements IDatabase{

	protected static $dbconfig;
	protected static $pdo;

	function __construct($dbconfig){
		self::$dbconfig=$dbconfig;
		$this->connect();
	}

	function connect(){
		$dbname=self::$dbconfig['dbname'];
		$host=self::$dbconfig['host'];
		$name=self::$dbconfig['user'];
		$pw=self::$dbconfig['password'];
		self::$pdo=new \PDO("mysql:dbname=$dbname;host=$host",$name,$pw);
	}

	function query($sql,$arr=null,$className=null){
		if(!(is_array($arr)) && !is_null($arr)){
			return false;
		}
		$stmt=self::$pdo->prepare($sql);
		$res=$stmt->execute($arr);

		if($className==null){
			$stmt->setFetchMode(\PDO::FETCH_ASSOC);
		}else{
			$stmt->setFetchMode(\PDO::FETCH_CLASS,$className);
		}

		if(!$res){return false;}
		
		$draft=$stmt->fetchAll();

		if(!$draft){return false;}

		return $draft;
	}

	function fetch($sql,$arr=null){
		if(!(is_array($arr)) && !is_null($arr)){
			return false;
		}

		$stmt=self::$pdo->prepare($sql);

		if(!$stmt){return false;}
		
		$stmt->execute($arr);
		$row=$stmt->fetch(\PDO::FETCH_ASSOC);
		return $row;
	}

	function execute($sql,$arr=null,$className=null){
		if(!(is_array($arr)) && !is_null($arr)){
			return false;
		}

		$stmt=self::$pdo->prepare($sql);
		$result=$stmt->execute($arr);
		if(!$result){
			return self::$pdo->errorInfo();
		}
		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	function close(){
		unset(self::$dbconfig);
		unset(self::$pdo);	
	}

}
