<?php

class myIterator implements Iterator{
	private $data;
	private $pos;

	function __construct($data){
		$this->data=$data;
		$this->pos=0;
	}

	function current(){
		return $this->data[$this->pos];
	}

	function next(){
		$this->pos++;
	}

	function key(){
		return $this->pos;
	}

	function valid(){
		return isset($this->data[$this->pos]);
	}

	function rewind(){
		$this->pos=0;
	}

}

$a=array('a','b','c','d','e','f');
$it=new myIterator($a);
foreach ($it as $key => $value) {
	print("$key:$value");
}

?>
