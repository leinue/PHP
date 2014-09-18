<?php

abstract class unit{
	abstract function add(unit $unit);
	abstract function remove(unit $unit);
}

class Army extends unit{

	public $value=0;

	function add(unit $unit){
		$this->value+=1;
	}

	function getValue(){
		return $this->vlaue;
	}

	function remove(unit $unit){
		$this->value=0;
	}
}

class Archer extends unit{

	function add(unit $unit){
		print_r($unit);
	}

	function remove(unit $unit){
		print_r("Archer::remove()");
	}
}

$main=new Army();

$main->add(new Archer());
$main->add(new Archer());

$sub=new Archer();

$sub->add(new Archer());

?>