<?php

abstract class workUnit{
	protected $tasks=array();
	protected $name=NULL;

	function __construct($name){
		$this->name=$name;
	}

	function getName(){
		return $this->name;
	}

	abstract add(Employee $e);
	abstract remove(Employee $e);
	abstract assignTask($task);
	abstract completeTask($task);
}

class Team extends workUnit{
	private $employees=array();

	function add(Employee $e){
		$this->employees[]=$e;
		echo "<p>$e->getName() has been added to the team $this->getName()</p>";
	}

	function remove(Employee $e){
		$index=array_search($e,$this->employees);
		unset($this->employees[$index]);
		echo "<p>$e->getName() has been removed from team $this->getName()</p>";
	}

	function assignTask($task){
		$this->tasks[]=$task;
		echo 'complete assign task';
	}

	function completeTask($task){
		$index=array_search($task,$this->tasks);
		unset($this->tasks[$index]);
		echo 'task has been removed';
	}
}

class Employee extends workUnit{
	function add(Employee $e){
		return fasle;
	}

	function remove(Employee $e){
		return false;
	}
	
	function assignTask($task){
		$this->tasks[]=$task;
		echo 'complete assign task';
	}

	function completeTask($task){
		$index=array_search($task,$this->tasks);
		unset($this->tasks[$index]);
		echo 'task has been removed';
	}
}

?>