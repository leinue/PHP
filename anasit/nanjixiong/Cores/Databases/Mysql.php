<?php

namespace Cores\Databases;

class Mysql implements IDatabase{

	protected static $dbconfig;
	private static $database;
	private static $connection;

	function __construct($dbconfig){
		error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
		self::$dbconfig=$dbconfig;
		$this->connect();
	}

	function connect(){
		if($this->isConnected()){return true;}

		self::$connection=mysql_connect(self::$dbconfig['host'],self::$dbconfig['user'],self::$dbconfig['password']);
		mysql_select_db(self::$dbconfig['dbname']);
		if(!$this->isConnected()){
			die('Could not connect: '.mysql_error());
		}
	}

	function query($sql){
		
		$query = $this->mysql_escape_mimic($sql);
		$result=mysql_query($query,self::$connection);
		
		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
		}

		if (is_bool($result)) {
			return mysql_affected_rows();
		}

		$array=array();
		for($i = 0; $array[$i] = mysql_fetch_assoc($result); $i++);
		array_pop($array);
		return $array;

	}

	function isConnected(){
		return self::$connection;
	}

	function execute($sql){
		$this->query($sql);
	}

	function mysql_escape_mimic($inp) {
	    if(is_array($inp))
	        return array_map(__METHOD__, $inp);

	    if(!empty($inp) && is_string($inp)) {
	        return str_replace(array('\\', "\0", "\n", "\r", "\x1a"), array('\\\\', '\\0', '\\n', '\\r', '\\Z'), $inp);
	    }

	    return $inp;
	}

	function close(){
		mysql_close($this->connection);
		unset($this->dbconfig);
		unset($this->connection);
		unset($this->database);
	}

}