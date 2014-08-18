<?php

class someclass{
	static private $instance=NULL;

	private $setting=array();

	private function __construct(){}
	private function __clone(){}

	static function getInstance(){
		if(self::$instance==NULL){
			self::$instance=new someclass();
		}

		return self::$instance;
	}

	function set($index,$value){
		$this->setting[$index]=$value;
	}

	function get($index){return $this->setting[$index];}
}

$obj1=someclass::getInstance();
$obj1->set("fuck","shit");

$obj2=someclass::getInstance();
echo $obj2->get("fuck");

?>