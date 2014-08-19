<?php

interface iSort{
	function sort(array $list);
}

class MultiAlphaSort implements iSort{
	private $order;
	private $index;

	function __construct($index,$order='ascending'){
		$this->index=$index;
		$this->order=$order;
	}

	function sort(array $list){
		switch ($this->order) {
			case 'ascending':
				uasort($list,array($this,'ascSort'));
				break;
			default:
				uasort($list,array($this,'descSort'));
				break;
		}

		return $list;
	}

	function ascSort($x,$y){
		return strcasecmp($x[$this->index],$y[$this->index]);}

	function descSort($x,$y){
		return strcasecmp($y[$this->index], $x[$this->index]);}
}

class MultiNumberSort implements iSort{
	private $order;
	private $index;

	function __construct($index,$order='ascending'){
		$this->index=$index;
		$this->order=$order;		
	}

	function sort(array $list){
		switch ($this->order) {
			case 'ascending':
				uasort($list,array($this,'ascSort'));
				break;
			default:
				uasort($list,array($this,'descSort'));
				break;
		}

		return $list;
	}

	function ascSort($x,$y){
		return $x[$this->index]>$y[$this->index];}

	function descSort($x,$y){
		return $y[$this->index]<$x[$this->index];}
}



?>