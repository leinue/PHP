<?php

namespace Cores\Databases;

class Mysqli implements IDatabase{

	protected static $dbconfig;
	protected static $mysqli;

	function __construct($dbconfig){
		self::$dbconfig=$dbconfig;
		$this->connect();
	}

	function connect(){
		self::$mysqli=mysqli_connect(self::$dbconfig['host'],self::$dbconfig['user'],self::$dbconfig['password'],self::$dbconfig['dbname']);
		if(!$this->isConnected()){
			die('Could not connect: '.mysqli_error(self::$mysqli));
		}
	}

	function isConnected(){
		return self::$mysqli;
	}

	function query($sql){
		$result = mysqli_query(self::$mysqli, $sql);
		$posts =  mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $posts;
	}

	function execute($sql){
		$stmt = mysqli_prepare(self::$mysqli,$sql);
		mysqli_stmt_execute($stmt);
		return mysqli_stmt_affected_rows($stmt);
	}


	function close(){
		unset(self::$dbconfig);
		unset(self::$mysqli);
	}

	function getMysqli(){
		return self::$mysqli;
	}

}
