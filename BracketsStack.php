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
		for($i=$this->length();$i>=0;$i--){
			print($this->elem[$i]."  ");
		}
	}

	function getTop(){
		return $this->top;
	}
}

$stack=new Stack();
//$stack->push('1');
//$stack->push('2');

//$stack->display();


$brackets='((((1)))';

for($i=0;$i<strlen($brackets);$i++){
	$key=$i;
	$value=$brackets[$key];
	
	if($value=='('){
		$stack->push($value);
	}elseif($value==')'){
		if(!$stack->isEmpty()){
			$stack->pop();
		}else{
			$stack->push(')');
		}
		
	}
}

//$stack->display();

if($stack->isEmpty()){
	echo 'valid';
}else{
	echo $stack->peek().' is not valid';
}


?>