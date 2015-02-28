<?php

class person{
	
	public $name;
	public $age;
	public $id;

	function __construct($name,$age){
		$this->name=$name;
		$this->age=$age;
	}

	function setID($num){
		$this->id=$num;
	}

	function __clone(){
		$this->id=0;
	}

}

$per=new person("fuck",18);
$per->setID(20);

$per2=clone $per;

echo "per1.id=".$per->id.";<br>";
//20

echo "per2.age=".$per2->age.";<br>";
echo "per2.name=".$per2->name.";<br>";
echo "per2.id=".$per2->id.";<br>";
?>