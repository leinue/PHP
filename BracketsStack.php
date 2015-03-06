<?php

/**
*  Stack类
*/
class Stack{
	private $top;
	private $elem=array();
	private $size;
	
	function __construct(){
		$this->top=0;
	}

	function clear(){
		$this->top=0;
	}

	function length(){
		return $this->top-1;
	}

	function isEmpty(){
		return $this->top==0;
	}

	function push($e){
		$this->elem[$this->top++]=$e;
		return true;
	}

	function peek(){
		if(!($this->isEmpty())){
			return $this->elem[$this->top-1];
		}else{
			return null;
		}
	}

	function pop(){
		if(!($this->isEmpty())){
			$res=$this->elem[--$this->top];
			return $res;
		}else{
			return null;
		}
	}

	function display(){
		//echo 'length='.$this->length();
		for($i=$this->length();$i>=0;$i--){
			print($this->elem[$i]."  ");
		}
	}
}

$stack=new Stack();
$stack->push('1');
$stack->push('2');

$stack->display();

?>