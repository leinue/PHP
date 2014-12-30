<?php
require('config.php');
/**
* location数据对象
*/
class location{
	private $latitude;
	private $longitude;
	
	function getLat(){
		return $this->longitude;
	}

	function getLong(){
		return $this->longitude;
	}

	function setLong($new){
		$this->longitude=$new;
	}

	function setLat($new){
		$this->latitude=$new;
	}
}

/**
* class pdoOperation
* 用于封装查询语句时的必须查询过程
* @submitQuery()使用pdo的预处理语句进行查询,比较安全
* @fetchClassQuery()返回对应数据库的class
* @fetchOdd()返回单个值
*/
class pdoOperation{

	public $updateLocation="UPDATE `location` SET `latitude`=?,`longitude`=? WHERE `uid`=?";
	public $deleteLocation="DELETE FROM `location` WHERE `uid`=?";
	public $insertLocation="INSERT INTO `location`(`latitude`, `longitude`) VALUES (?,?)";
	public $selectLocation="SELECT * FROM `location` WHERE `uid`=?";
	public $selectAll="SELECT * FROM `location`";

	protected static $pdo;
	
	function __construct($pdo){
		self::$pdo=$pdo;
		self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //禁用prepared statements的仿真效果
	}

	function submitQuery($sql,$arr){
		if(!(is_array($arr))){
			return false;
		}
		$stmt=self::$pdo->prepare($sql);
		$result=$stmt->execute($arr);
		return $result;
	}

	function fetchClassQuery($sql,$arr,$className){
		if(!(is_array($arr))){
			return false;
		}
		$stmt=self::$pdo->prepare($sql);
		$res=$stmt->execute($arr);

		$stmt->setFetchMode(PDO::FETCH_CLASS,$className);

		if ($res) {
			if($draft=$stmt->fetchAll()) {
				return $draft;
			}else{
				return false;}
		}else{
			return false;}
	}

	function fetchOdd($sql,$arr){
		if(!(is_array($arr))){
			return false;
		}
		$stmt=self::$pdo->prepare($sql);

		if($stmt){
			$stmt->execute($arr);
			$row=$stmt->fetch();
			return $row;
		}else{return false;}
	}
}

class locationManager extends pdoOperation{

	function __construct($pdo){
		parent::$pdo=$pdo;
	}

	function updateLocation($lat,$long,$uid){
		return $this->submitQuery($this->updateLocation,array($lat,$long,$uid));
	}

	function insertLocation($lat,$long){
		return $this->submitQuery($this->insertLocation,array($lat,$long));
	}

	function deleteLocation($uid){
		return $this->submitQuery($this->deleteLocation,array($uid));
	}

	function selectLocation($uid){
		return $this->fetchOdd($this->selectLocation,array($uid));
	}

	function getAll(){
		return $this->fetchClassQuery($this->selectAll,array(),'location');
	}
}

?>