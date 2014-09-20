<?php

/*
this is a test of iterator
*/

class myIterator implements Iterator{
	private $pos=0;
	private $data=array();

	function __construct($data){
		$this->pos=0;
		if(is_array($data)){
			$this->data=$data;
		}else{
			echo 'can not accept variable';
		}
	}

	function current(){
		var_dump(__METHOD__);
		return $this->data[$this->pos];
	}

	function key(){
		var_dump(__METHOD__);
		return $this->pos;
	}

	function next(){
		var_dump(__METHOD__);
		$this->pos++;
	}

	function valid(){
		var_dump(__METHOD__);
		return isset($this->data[$this->pos]);
	}

	function rewind(){
		var_dump(__METHOD__);
		$this->pos=0;
	}
}

$it=new myIterator(array(1,2,3,4,5));

foreach ($it as $key => $value) {
	var_dump($key,$value);
	echo " <br>";
}

?>