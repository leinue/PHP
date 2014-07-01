<?php
/**
* 
*/
class cls_mysql
{
	protected $link_id;
	
	public function __construct($dbhost,$dbuser,$dbpw,$dbname="",$charset='utf8')
	{
		# code...
		if(!($this->$link_id=mysql_connect($dbhost,$dbuser,$dbpw)){
			return false;
		}

		mysql_query("SET NAMES ".$charset,$this->link_id);

		if($dbname){
			if(mysql_select_db($dbname,$this->link_id)===false){
				return false;
			}
			else{
				return true;
			}
		}

	}

	public function __destruct(){
		mysql_close($this->link_id);
	}

	public function select_db($dbname){
		return mysql_select_db($dbname);
	}

	public function fetch_array($query,$result_type=MYSQL_ASSOC){
		return mysql_fetch_array($query,$result_type);
	}

	public function affected_rows(){
		return mysql_affected_rows($this->link_id);
	}

	public function query($sql){
		return mysql_query($sql,$this->link_id);
	}

	public function num_rows($query){
		return mysql_num_rows($query);
	}

	public function insert_id(){
		return mysql_insert_id($this->link_id);
	}

	public function select_limit($sql,$num,$start=0){
		if($start==0){
			$sql.=' LIMIT '.$num;
		}
		else{
			$sql.=' LIMIT '.$start.','.$num;
		}
		return $this->query($sql);
	}

	public function getone($sql,$limited=false){
		if($limited==true){
			$sql=trim($sql.' LIMIT 1');
		}

		$res=$this->query($sql);
		if($res!=false){
			$row=mysql_fetch_row($res);
			return $row[0];
		}
		else{return false;}
	}

	public function getall($sql){
		$res=$this->query($sql);
		if($res!=false){
			$arr=array();
			while($row=mysql_fetch_assoc($res)){
				$arr[]=$row;
			}
			return $arr;
		}
		else{return false;}
	}

	public function MSGerror($message='',sql=''){
		if($message){echo "<b>error info</b>:$message\n\n";}
		else{echo "<b>MySQL server error report:";print_r($this->error_message);}
	}
}
?>