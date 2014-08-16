<?php

interface iCrud{
	function create($data);
	function read();
	function update($data);
	function delete();
}

class user implements iCrud{
	private $userID;
	private $userName;

	function __construct($data){
		$this->userID=uniqid();
		$this->userName=$data['username'];}

	function read(){
		return array('userid'=>$this->userID,
			'username'=>$this->userName);}

	function update($data){
		$this->userName=$data['username'];		}

	function create($data){
		self::__construct($data);}

	function delete(){
		$this->userID=NULL;
		$this->userName=NULL;
	}
}

?>